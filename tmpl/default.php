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
<button type="button" id="sis-button" class="header-item-content" style="border: none;"><span class="header-item-icon"><span id="sis-item-icon" style="margin: 3px; font-size: 1.2rem; transition: all .6s ease;">🌓</span></span></button>
<script>
window.addEventListener('load', function() {
  let darkMode = getDarkModeLocalStorage();
  
  if (darkMode === null){
    const htmlTag = document.getElementsByTagName('html')[0];
    if(htmlTag.getAttribute('data-color-scheme') == 'dark'){
      let darkMode = 'true';
      updateButton(darkMode);
      updateMode(darkMode);
      setDarkModeLocalStorage('true');
    } else{
      darkMode = 'false';
      updateButton(darkMode);
      updateMode(darkMode);
      setDarkModeLocalStorage('false');
    }
  } else{
    if(darkMode === 'true'){
      let darkMode = 'true';
      updateButton(darkMode);
      updateMode(darkMode);
      setDarkModeLocalStorage('true');
    } else{
      let darkMode = 'false';
      updateButton(darkMode);
      updateMode(darkMode);
      setDarkModeLocalStorage('false');
    }
  }
});

function updateButton(darkMode) {
  const icon = document.getElementById("sis-item-icon");
  if (darkMode === 'true') {
    icon.innerHTML = "🌙";
    icon.style.backgroundColor = "rgb(31, 48, 71)";
  } else {
    icon.innerHTML = "☀️";
    icon.style.backgroundColor = "transparent";
  }
}

function updateMode(darkMode) {
  const htmlTag = document.getElementsByTagName('html')[0];
  if (darkMode === 'true') {
    htmlTag.setAttribute('data-bs-theme', 'dark');
    htmlTag.setAttribute('data-color-scheme', 'dark');
  } else {
    htmlTag.setAttribute('data-bs-theme', 'light');
    htmlTag.setAttribute('data-color-scheme', 'light');
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

let sisBtn = document.getElementById("sis-button");
sisBtn.addEventListener("click", () => {
  let darkModeStorage = getDarkModeLocalStorage();
  if(darkModeStorage === 'true'){
    darkMode = 'false';
  } else {
    darkMode = 'true';
  }
  setDarkModeLocalStorage(darkMode);
  updateButton(darkMode);
  updateMode(darkMode);
});
</script>