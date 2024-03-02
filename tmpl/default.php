<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_sis_darkmode
 *
 * @copyright	Copyright © 2024 - All rights reserved.
 * @license		GNU General Public License v2.0
 * @author 		Sergio Iglesias (@sergiois)
 */

defined('_JEXEC') or die;
?>

<button type="button" class="header-item-content dms-button" style="border: none;"> <span class="header-item-icon"> <span style="margin: 3px; font-size: 1.2rem; transition: all .6s ease;">🌓</span> </span></button>
<script>
  (() => {
    'use strict';
  
    // Run script only once
    if (typeof window.jDarkMode !== "undefined") return;
  
    // Initial settings
    let darkMode = window.jDarkMode = (getDarkModeLocalStorage() === "true");
    setDarkModeLocalStorage(darkMode);
    // Update the first visible "Dark Mode Switcher" button to avoid flickering
    updateButton(document.querySelector("button.dms-button"), darkMode);
    updateMode(darkMode);
  
    function updateButton(btn, darkMode) {
      const icon = btn.querySelector(".header-item-icon > span");
      const text = btn.querySelector(".header-item-text");
      if (darkMode) {
        icon.innerHTML = "🌙";
        icon.style.backgroundColor = "rgb(31, 48, 71)";
        //text.innerHTML = "Dark Mode";
      } else {
        icon.innerHTML = "☀️";
        icon.style.backgroundColor = "transparent";
        //text.innerHTML = "Light Mode";
      }
    }
  
    function updateMode(darkMode) {
      for (const sheet of document.styleSheets) {
        //if (sheet.href && sheet.href.includes("atum/css/template")) {
        for (let i = sheet.cssRules.length - 1; i >= 0; i--) {
          let rule = sheet.cssRules[i].media;
          if (typeof rule !== "undefined" && rule.mediaText.includes("prefers-color-scheme")) {
            if (darkMode) {
              if (!rule.mediaText.includes("(prefers-color-scheme: light)")) rule.appendMedium("(prefers-color-scheme: light)");
              if (!rule.mediaText.includes("(prefers-color-scheme: dark)")) rule.appendMedium("(prefers-color-scheme: dark)");
              if (rule.mediaText.includes("original")) rule.deleteMedium("original-prefers-color-scheme");
            } else { //else if (!darkMode) {
              rule.appendMedium("original-prefers-color-scheme");
              if (rule.mediaText.includes("light")) rule.deleteMedium("(prefers-color-scheme: light)");
              if (rule.mediaText.includes("dark")) rule.deleteMedium("(prefers-color-scheme: dark)");
            } /*else {
              rule.appendMedium("(prefers-color-scheme: dark)");
              if (rule.mediaText.includes("light")) rule.deleteMedium("(prefers-color-scheme: light)");
              if (rule.mediaText.includes("original")) rule.deleteMedium("original-prefers-color-scheme");        
            }*/
          }
        }
        //}
      }
    }
  
    // Sets localStorage state
    function setDarkModeLocalStorage(state) {
      localStorage.setItem("jDarkMode", state);
    }
  
    // Gets localStorage state
    function getDarkModeLocalStorage() {
      return localStorage.getItem("jDarkMode");
    }
  
    // Update all "Dark Mode Switcher" buttons after DOMContentLoaded
    document.addEventListener('DOMContentLoaded', () => {
      const dmsBtns = document.querySelectorAll("button.dms-button");
      dmsBtns.forEach((dmsBtn) => {
        updateButton(dmsBtn, darkMode);
        // Set eventListeners for all "dark-mode"-toggle-buttons on click and set localStorage
        dmsBtn.addEventListener("click", () => {
          let darkMode = window.jDarkMode = (getDarkModeLocalStorage() === "false");
          setDarkModeLocalStorage(darkMode);
          dmsBtns.forEach((dmsBtn) => updateButton(dmsBtn, darkMode));
          updateMode(darkMode);
        });
      });
    });
  
  })();
</script>