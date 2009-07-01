<?php

class cre8SwitchLanguageFilter extends sfFilter
{
 
  /**
   * Check that the language is a valid application culture.
   * @param string $language The tested language code
   * @param string $default_language The default language code
   * 
   * @return string $language if no accepted languages is set,
   *                else $language if it is in accepted languages
   *                else $default_language
   */
  private function getAvailableCulture($language, $default_language = null)
  {
    $all_languages = sfConfig::get('app_accepted_languages', array());
 
    if(count($all_languages))
    {
      if(in_array($language, $all_languages)) // Test if language is available
      {
        return $language;
      }
      else // Else test if first part of language is available
      {
        $language_parts = explode('_', $language);
        if(count($language_parts))
        {
          if(in_array($language_parts[0], $all_languages))
          {
            return $language_parts[0];
          }
        }
      }
      return $default_language;
    }
 
    return $language;
  }
 
  /**
   * The filter call.
   */
  public function execute ($filterChain)
  {
    $context = $this->getContext();
    $user = $context->getUser();
 
    $default_culture = sfConfig::get('sf_i18n_default_culture');
    $selected_culture = $user->getCulture();
 
    if(!$user->getAttribute('sf_culture_autodetected', false))
    {
      $browser_languages = $context->getRequest()->getLanguages();
 
      foreach($browser_languages as $language)
      {
        $allowed_culture = $this->getAvailableCulture($language);
        if($allowed_culture)
        {
          $selected_culture = $allowed_culture;
          break;
        }
      }
 
      $user->setAttribute('sf_culture_autodetected', true);
    }
 
    $selected_culture = $context->getRequest()->getParameter('sf_culture', $selected_culture);
    $selected_culture = $this->getAvailableCulture($selected_culture, $default_culture);
    if($selected_culture != $user->getCulture())
    {
      // The user wants to see the page in another language
      $user->setCulture($selected_culture);
    }
 
    $filterChain->execute();
  }
}
