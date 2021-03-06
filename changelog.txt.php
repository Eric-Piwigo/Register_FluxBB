<?php
/*
:: HISTORY

2.0.0b - 23/11/08  - Initial release. Basic changes to be available for Piwigo 2.0RC4

2.0.1b - 24/11/08  - Small bug correction on submit button display

2.0.2	- 19/02/09	- Language pack correction

2.1.0	- Admin panel with tabsheets
      - Radio buttons functionnalities corrections (now radio buttons show the configuration saved in database)
      - Language files (fr - en) improvement

2.1.1	- Bug fixed on profile update

2.1.2	- Compatibility bug fixed when used with DynamicRecentPeriod plugin

2.1.3 - Using sha1 hash instead of md5 for password hashing in FluxBB
      - Escaping all characters in login names and be able to retreive them without slashes - FluxBB does not allow this so Piwigo's user names with escaped characters will not been escaped in FluxBB (ie : "it's" in Piwigo will be "It\'s" in FluxBB)
      - Code refactoring
      - Full HTML 4.0 for tpl

2.2.0 - Piwigo 2.1 compatibility
      - Adding css file
      - Templates refactory: Moved with css in a "template" subdirectory of admin directory, Moving icons in template directory, using css rules to improve important text display
      - functions_Register_FluxBB.inc.php renamed in functions.inc.php
      - Language files revision
      - Obsolete files management

2.2.1 - Bug 1577 fixed : Multiple database support

2.2.2 - Bug 1674 fixed : Adding of mods for Fluxbb when users loose their password
      - Adding of German language (Thx to duke)

2.2.3 - Bug 1674 re-fixed : Bad link fixed
      - Re-adding of German language that was missed at last release :-( (Thx to duke)

2.2.4 - Bug 1812 fixed : Compliance with FluxBB 1.4

2.3.0 - Bug 1434 fixed : Bridge between Register_FluxBB and UserAdvManager for new users validation

2.3.1 - Bug 1825 fixed : Password corruption after Piwigo's profile page visit

2.3.2 - Bug 1847 fixed : Admins and webmasters was not excluded from registration validation

2.3.3 - Bug 1853 fixed : Add of controls on plugin configuration settings to avoid some mistakes
      - Bug 1855 fixed : Improvement of use of UAM bridge (fixes php notices)
      - Several language files fix

2.3.4 - Compatibility with Plugin Adult_Content

2.3.5 - Bug 2047 fixed : Check case sensitivity for logins in FluxBB's user table
      - Code refactory and optimization

2.3.6 - Bug 2051 fixed : Compatibility with Captcha

2.3.7 - Bug 2154 fixed : Bad fluxbb table name

2.4.0 - Compliance with Piwigo 2.2

2.4.1 - Enhanced compliance with Piwigo 2.2 (using combine_css)

2.4.2 - Bug fixed on previous version update

2.4.3 - Small CSS bug fixed

2.4.4 - Small code refactory
      - Compatibility with Piwigo 2.4 and FluxBB 1.5 verifyed

2.4.5 - Update translations - Thx to ddtddt

2.4.6 - Add it_IT, thanks to : Gdvpixel and Ericnet
      - Add uk_UA, thanks to : animan
      - Add ru_RU, thanks to : nadusha

2.4.7 - Update it_IT, thanks to : Ericnet
      - Update ru_RU, thanks to : rocket
      - Add cs_CZ - Cesky � Czech, Thanks to : webprostor
      - Update uk_UA, thanks to : animan
      - Update el_GR, thanks to : bas_alba

2.4.8 - Update uk_UA, thanks to : animan
      - Update it_IT, thanks to : virgigiole
      - Add da_DK, thanks to : Kaare
      - Add es_ES, thanks to : petaqui

2.4.9 - Update es_ES, thanks to : jpr928
      - Update tr_TR, thanks to : LazBoy
      - Update it_IT, thanks to : virgigiole
      - Update pl_PL, thanks to : kuba
      - Bad explanation in inline tips fixed

2.5.0 - Compliance with Piwigo 2.5
      - Code refactory : Plugin's configuration vars are now serialized in database
      - Admin panel refactory : No more tabs
      - Admin panel refactory : Clear and dark administration theme compatibility
      - English language reference review
      - Compliance improved with FluxBB 1.5 - Register_FluxBB is still compatible with 1.2 and 1.4 FluxBB forums
      - Update tr_TR, thanks to : LazBoy
      - Update it_IT, thanks to : Ericnet
      - Update pl_PL, thanks to : K.S.

2.5.1 - Fix Bad submit button align
      - Fix admin panel display issue
      - Update es_ES, thanks to : jpr928

2.5.2 - Bug fixed : Missing PHInfos() error
      - Update tr_TR, thanks to : LazBoy
      - Update lv_LV, thanks to : agrisans
      - Update ru_RU, thanks to : marchelly
      - Update el_GR, thanks to : bas_alba
      - Update it_IT, thanks to : lucser
      - Update da_DK, thanks to : Kaare
      - Update de_DE, thanks to : Yogie

2.5.3 - Bug fixed : MySql error after installation from scratch

2.5.4 - Bug fixed : Admins passwords synchronization between FluxBB and Piwigo when changed
      - Bug fixed : Password synchronization between FluxBB and Piwigo if a user uses Piwigo's password recovery system
      - Bug fixed : Exclude password comparison from audit
      - Bug fixed : New workflow for installation from scratch with recoded users synchronization and audit actions. No more migration needed. Password synch is initiated by users themself.

2.5.5 - Bug fixed : Missing database upgrade

2.5.6 - Bug fixed : Message for password change request not displayed on profile page

2.5.7 - Rebuild of previous version due to file corruption

2.5.8 - Add accounts synchronization from FluxBB to Piwigo
      - Bug fixed : Missing function in audit

2.5.9 - Bug fixed : Adding accounts from FluxBB to Piwigo was not working
        // TODO: Compatibility with user_mass_register

2.5.10 - Update tr_TR, thanks to : LazBoy
         Update es_ES, thanks to : jpr928
         Update lv_LV, thanks to : agrisans
         Update el_GR, thanks to : bas_alba
         Update de_DE, thanks to : Yogie

2.5.11 - Update ru_RU, thanks to : Konve
         Update it_IT, thanks to : Ericnet

2.5.12 - Add pt_BR, thanks to : flaviove
         Update ru_RU, thanks to : Konve
         Translation keys fixed

2.5.13 - Compatibility fixed with other plugins (UAM and Prune_History)
         Update da_DK, thanks to : Kaare
         Update de_DE, thanks to : stephy and Yogie
         Update el_GR, thanks to : bas_alba
         Update es_ES, thanks to : jpr928
         Update tr_TR, thanks to : LazBoy
         Update lv_LV, thanks to : agrisans
         Update it_IT, thanks to : Ericnet
         Update uk_UA, thanks to : tb0hdan
         Update pt_BR, thanks to : flaviove

2.5.14 - Fix a FluxBB issue (FluxBB mod) : When a new user registers, "Newest registered user" does not show him. See instruction in "About user registration in the FluxBB forum" section
       - Update pl_PL, thanks to : T00kie
       - Add pt_PT, thanks to : ANO

2.6.0  - Compatibility with Piwigo 2.6 checked
       - Update pt_PT, thanks to : ANO
       - Add sk_SK, thanks to : Jimako

2.7.0  - Compatibility with Piwigo 2.7
       - Update sk_SK, thanks to : JoeKundlak
       - Update it_IT, thanks to : Ericnet

2.7.1  - Update uk_UA, thanks to : StreamThreader
       - Add nl_NL, thanks to : Blackbird

2.7.2  - Add nb_NO, thanks to paulen

2.8.0  - Update zh_CN, thanks to winson
*/
?>