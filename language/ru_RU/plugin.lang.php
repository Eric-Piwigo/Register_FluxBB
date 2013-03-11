<?php
// +-----------------------------------------------------------------------+
// | Piwigo - a PHP based photo gallery                                    |
// +-----------------------------------------------------------------------+
// | Copyright(C) 2008-2012 Piwigo Team                  http://piwigo.org |
// | Copyright(C) 2003-2008 PhpWebGallery Team    http://phpwebgallery.net |
// | Copyright(C) 2002-2003 Pierrick LE GALL   http://le-gall.net/pierrick |
// +-----------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify  |
// | it under the terms of the GNU General Public License as published by  |
// | the Free Software Foundation                                          |
// |                                                                       |
// | This program is distributed in the hope that it will be useful, but   |
// | WITHOUT ANY WARRANTY; without even the implied warranty of            |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU      |
// | General Public License for more details.                              |
// |                                                                       |
// | You should have received a copy of the GNU General Public License     |
// | along with this program; if not, write to the Free Software           |
// | Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, |
// | USA.                                                                  |
// +-----------------------------------------------------------------------+
$lang['Config_Disclaimer'] = 'Проверьте настройки FluxBB и исправьте их, если это необходимо. <br>
Подстройте поведение плагина чтобы было удобно.';
$lang['Config_Title'] = 'Установка плагина';
$lang['Del_Pt_false'] = ' --&gt; Не удалять темы и сообщения';
$lang['Del_Pt_true'] = ' --&gt; Удалить все';
$lang['Error_Synchro_Mail'] = 'в email';
$lang['Error_Synchro_Pswd'] = 'в пароле';
$lang['Error_Synchro'] = '<b>Ошибка синхронизации учетной записи:</b> ';
$lang['Guest'] = 'Имя пользователя для гостевого входа.';
$lang['Mig_Btn'] = 'Перенос';
$lang['Mig_End'] = '<b>Перенос выполнен!</b>';
$lang['Mig_Start'] = '<b>Перенос учетных записей из Piwigo в FluxBB</b>';
$lang['Mig_Title'] = 'Перенос учетных записей из Piwigo в FluxBB';
$lang['Prefix'] = 'Префикс таблиц FluxBB:';
$lang['Sync_Btn'] = 'Синхронизация';
$lang['Sync_OK'] = 'Синхронизация успешно завершена<br><br>';
$lang['Sync_User'] = 'Синхронизация учетных записей:';
$lang['Tab_Info'] = 'Инструкции';
$lang['Tab_Manage'] = 'Шаг 1: Настройка плагина';
$lang['Tab_Migration'] = 'Шаг 2: Перенос учетных записей';
$lang['Tab_Synchro'] = 'Обслуживание: синхронизация учетных записей';
$lang['Title'] = 'Регистрация FluxBB';
$lang['save_config'] = 'Настройки сохранены';
$lang['About_Reg'] = 'О регистрации пользователей на форуме FluxBB';
$lang['Admin'] = 'Имя администратора Piwigo. <b style="color: red">Имя учетной записи администратора  FluxBB должно быть одинаковым!</b>';
$lang['Advise_Check_Dup'] = '<b>Невозможно продолжить синхронизацию, пока есть совпадающие имена учетных записей Piwigo и FluxBB.</b><br><br>';
$lang['Advise_FluxBB_Dup'] = '<b>ВНИМАНИЕ!  Прежде чем продолжить, вы должны внести эти исправления<br>используйте пиктограммы, чтобы удалить пользователей из FluxBB и разрешить проблему.</b>';
$lang['Advise_PWG_Dup'] = '<b> ВНИМАНИЕ!  Прежде чем продолжить, вы должны внести эти исправления <br>используйте менеджер пользователей Piwigo для разрешения проблемы.</b>';
$lang['Audit_Btn'] = 'Проверка';
$lang['Audit_FluxBB2PWG'] = '<b>Проверка существующих учетных записей в FluxBB и отсутвующих в Piwigo</b>';
$lang['Audit_FluxBB_Dup'] = '<b>Проверка таблицы учетных записей FluxBB</b>';
$lang['Audit_Link_Bad'] = '<b>Проверка битых ссылок между учетными записями в Piwigo и FluxBB</b>';
$lang['Audit_Link_Break'] = '<b>Проверка доступных к восстановлению ссылок между учетными записями в Piwigo и FluxBB</b>';
$lang['Audit_OK'] = 'Проверка прошла успешно<br><br>';
$lang['Audit_PWG2FluxBB'] = '<b>Проверка существующих учетных записей в FluxBB и отсутвующих в Piwigo</b>';
$lang['Audit_PWG_Dup'] = '<b>Проверка таблицы учетных записей FluxBB</b>';
$lang['Audit_Synchro_OK'] = ' <b>: Синхронизация данных прошла успешна</b>';
$lang['Confirm_true'] = '--&gt; Удалить подтвеждение';
$lang['Confirm'] = 'Удалить подтвеждение на административные действия в проверках.';
$lang['Del_Pt'] = 'Удаление тем и постов после удаления пользователя.';
$lang['Disclaimer'] = ' *** Чтобы начать использование, следуйте этим двум шагам ***<br>
Шаг 1: Установите плагин с параметрами FluxBB.<br>
Шаг 2: Перенесите учетные записи пользователей из Piwigo в FluxBB.<br><br>
После этих основных шагов плагин будет польностью рабочий и вам не придется возвращаться к этим страницам.<br><br>
 *** Для обслуживания уже открытых соединений ***<br>
Обслуживание: Синхронизация таблиц (в случае несоответсвий  при обновлении, дополнении или удалении пользователя) позволяет обновлять пароли и адреса электронной почты пользователей. (Но у вас не должно возникать необходимости использовать это).
<br><br>
  <div class="warning">Внимание !! Для вашей безопасности не забывате делать резервные копии базы данных, особенно таблиц ###_user перед любым действием.</div>
<br><br>
  <div class="warning">Необходимо знать:<br>
  По умолчанию <b>FluxBB</b> <u>нечувствителен</u> к регистру имен пользователей. Так что, если пользователем с именем "test" уже зарегестрировался, другие попытки регистраций вроде "Test", или "TEST", или "TEst", будут отвергнуты.<br><br>
  По умолчанию <b>Piwigo</b>, наоборот, <u>чувствителен</u> к именам ("test", "Test", "TEST", и т.д. - это разные пользователи).<br>
  Чтобы избежать проблем (хотя поведение Piwigo лекго изменить - См. опции), Register_FluxBB будет связывать эти два приложения в стиле FluxBB: Будучи <u>нечувствительным</u> к регистру имен пользователей.<br><br></div>';
$lang['Error_FluxBB2PWG'] = '<b>Аккаунт FluxBB не зарегестированный в Piwigo:</b> ';
$lang['Error_FluxBB_Dup'] = '<b>Ошибка в таблице аккаунтов FluxBB - найдены дубликаты:</b> ';
$lang['Error_Link_Break'] = '<b>Нерабочая связь между аккаунтами Piwigo и FluxBB:</b> ';
$lang['Error_Link_Dead'] = '<b>Ошибка в таблице связей - мертвые связки:</b> ';
$lang['Error_Link_Dup'] = '<b>Ошибка в таблице связей - найдены дубликаты:</b> ';
$lang['Error_PWG2FluxBB'] = '<b>Аккаунт Piwigo не зарегестированный во FluxBB:</b> ';
$lang['Error_PWG_Dup'] = '<b>Ошибка в таблице аккаунтов Piwigo - найдены дубликаты:</b> ';
$lang['About_Bridge'] = 'O Register_FluxBB / UAM bridge';
$lang['Add_User'] = 'Добавление аккаунта в FluxBB:';
$lang['Audit_Synchro'] = '<b>Аудит синхронизации паролей и адресов электронной почты между учетными записями Piwigo и FluxBB</b>';
$lang['Bridge_UAM_false'] = ' --> Отключить связь Register_FluxBB / UAM (по-умолчанию)';
$lang['Bridge_UAM_true'] = ' --> Включить связь Register_FluxBB / UAM ';
$lang['Bridge_UAM'] = 'Проверка доступа на форум через плагин UserAdvManager (UAM): Включите связь между двумя плагинами, что позволит запретить доступ к вашим форумом FluxBB, пока пользователь не пройдет проверку его регистрации в галерее (функция должна быть активна на UAM).';
$lang['Del_User'] = 'Удаление из аккаунта FluxBB:';
$lang['Details_false'] = '--&gt; Показывает большинство результатов операции';
$lang['Details_true'] = ' --&gt; Все подробности о результатах операции.';
$lang['Details'] = 'Уровень детализации в отчетах операций.';
$lang['Error_Link_Del'] = '<b>Ошибка в таблице ссылок между 2 пользователями:</b> ';
$lang['FluxBB_Group'] = 'Укажите идентификатор  <b>группы FluxBB "</ B>, в которой находятся непроверенные пользователи (должна быть создана заранее в FluxBB). Чтобы быть эффективной, эта группа не должна иметь разрешение на форуме (см. в конце этой странице сведения об использовании этой опции).';
$lang['Link_Dead'] = 'Удалить нерабочие ссылки';
$lang['Link_Del'] = 'Удалить ссылку:';
$lang['Link_Dup'] = 'Удалить дубли';
$lang['Mig_Add_AllUsers'] = '<b>Перенос учетных записеи Piwigo</b>';
$lang['Mig_Add_User'] = '<b>Перенос учетной записи:</b> ';
$lang['Mig_Del_AllUsers'] = '<b>Удаление учетных записеи FluxBB</b>';
$lang['Mig_Del_Link'] = '<b>Удаление связей между аккаунтами Piwigo и FluxBB</b>';
$lang['Confirm_false'] = '--&gt; Подвеждение обязательно перед действиями в аудите';
$lang['Mig_Del_User'] = '<b> Удаление учетной записи: </b>';
$lang['Mig_Disclaimer'] = 'div class="warning"> НИКОГДА НЕ ВЫПОЛНЯЙТЕ ОПЕРАЦИЮ МИГРАЦИИ ДЛЯ ОБНОВЛЕНИЯ!!!</div>';
$lang['Mig_Text'] = '<div class="warning"> ИСПОЛЬЗОВАТЬ ТОЛЬКО, если вы никогда не использовали плагин для связи Piwigo и FluxBB <u>И ЕСЛИ</ U> ваш форум не содержит пользователей!</b></div><br>
  		--> В этом случае, ваша таблица  [PrefixFluxBB]_user в FluxBB не должна содержать ни одного аккаунта, кроме 2 гостевых и адиминистратора.<br><br>
  - Миграция сначала удалит ссылки между учетными записями Piwigo и FluxBB<br>
  - Затем <b> будут удалены все УЧЕНЫЕ ЗАПИСИ FluxBB</b>, за исключением 2-х гостевых и администратора.<br>
  <br>
  <div class="warning">ВНИМАНИЕ: ЕСЛИ У ВАС ЕСТЬ НУЖНЫЕ УЧЕТНЫЕ ЗАПИСИ В FluxBB == НЕ используйте эту функцию!</div><br>
  - Наконец, миграция создаст учетные записи всех пользователей Piwigo в FluxBB, кроме гостей.<br>
  <br>
  При возникновении ошибки во время работы, устраните причину проблемы и повторите операцию миграции (в том случчае только вы сможете продолжить  операцию миграции).<br>';
$lang['New_Link'] = 'Связанные учетные записи:';
$lang['No_Reg_advise'] = 'Для более тесной интеграции, целесообразно сделать следующие изменения в форуме FluxBB (<b>Предупреждение: Эти изменения исчезнут при обновлении форума</b>):
<br><br>
  <b>* В панели администрирования FluxBB, переключите "Разрешить новые регистрации", в положение НЕТ (в: Настройки - Регистрация)</b>
<br><br>
  <b>* Внесите изменения в файл</b>: [FluxBBRoot]/lang/English/register.php путем вненсения изменения в эту строчку
  <div class="mod">\'No new regs\'				=>	\'This forum is not accepting new users.\'</div>
  <b>with :</b>
  <div class="info">\'No new regs\'				=>	\'&lt;a href=&quot;http://[YourPiwigoRoot]/register.php&quot; &gt; Go here to register &lt;/a&gt;&lt;br/&gt;&lt;br/&gt;\'</div>
  <br>
  Конечно, вам нужно проделать эти измененения для всех необходимых языков форума FluxBB.
<br><br>
  <b>* Внесите изменения в файл</b> : [FluxBBRoot]/login.php заменой строки 69:
  <div class="mod">message($lang_login[\'Wrong user/pass\'].\'&lt;a href=&quot;login.php?action=forget&quot;&gt;</div>
  <b>заменить на:</b>
  <div class="info">message($lang_login[\'Wrong user/pass\'].\'&lt;a href=&quot;../[PiwigoRoot]/password.php&quot;&gt;</div>
<br>
  и на строке 216:
  <div class="mod">&lt;a href=&quot;login.php?action=forget&quot; tabindex=&quot;5&quot;><?php echo $lang_login[\'Forgotten pass\']</a></p></div>
  <b>заменить на:</b>
  <div class="info">&lt;a href=&quot;../[PiwigoRoot]/password.php&quot; tabindex=&quot;5&quot;><?php echo $lang_login[\'Forgotten pass\']</a></p></div>
  <br>';
$lang['Sync_Check_Dup'] = '<b> Анализ таблицы учетные записи Piwigo и FluxBB на предмет дубликатов </b>';
$lang['Sync_DataUser'] = '<b> Анализ паролей и адресов электронной почты между учетными записями в Piwigo и FluxBB </b>';
$lang['Sync_FluxBB2PWG'] = '<b> Анализ существующих учетных записей в FluxBB и отсутствующих в Piwigo </b>';
$lang['Sync_Link_Bad'] = '<b> Анализ плохих связок между учетными записями в Piwigo и FluxBB </b>';
$lang['Sync_Link_Break'] = '<b> Анализ подлежащих восстановлению связей между учетными записями в Piwigo и FluxBB </ B>';
$lang['Sync_PWG2FluxBB'] = '<b> Анализ существующих учетных записей в Piwigo и отсутствующих в FluxBB </ B>';
$lang['Sync_Text'] = '  <div class="warning">Вы уже использовали плагин для связи Piwigo (плагин обновления) и/или ваш FluxBB форум содержит пользователей!</div>
  <br> -> Это означает, что на форуме пристутсвуют пользователи.<br><br>
  - Синхронизация обнаруживает данные, сверя имена пользователей, пароли (в зашифрованном виде), адреса электронной почты в обеих таблицах [PrefixPWG]_user и [PrefixFluxBB]_user.<br>
  - Затем обновляет таблицу соответствия, а также пароль и адрес электронной почты для каждой учетной записи из Piwigo в FluxBB кроме Piwigo гостей и FluxBB Anonymous.<br>
  - Наконец показывет одинокие учетные записи, которые существуют только в одном из 2 ###_user tables.<br>
  <br>
  В конце операции, запустите проверки и проверьте пользователей в FluxBB на предмет дубликатов. В случае, если они окажутся, удалите наиболее старых (установите сортировку FluxBB пользователей в соответствии с датой их регистрации).<br>';
$lang['Sync_Title'] = 'Синхронизировать учетные записи из Piwigo в FluxBB';
$lang['Title_Tab'] = 'Register_FluxBB - Версия: ';
$lang['UAM_Bridge_advice'] = 'Плагин UserAdvManager позволяет заставить вновь зарегестировавшихся пользователей подтвержтать свою регистрацию, прежде чем разрешить им доступ ко всей галерее. Совместное использование этого плагина с Register_FluxBB может сделать то же самое на связанных форумах: новые пользователи не могут писать в форум, пока не подтверждена их регистрация в галерее.<br>
Вот общее описание процедуры:
<br>
- В админской панели вашего форума FluxBB, создайте, по крайней мере, 2 группы пользователей (например: "проверенные" и "непроверенные").<br>
- Дайте первой группе("проверенные") любые права на форуме, как вам больше нравится и установите группой по-умолчанию.<br>
- Удалите у второй группы ("непроверенные") все права на форуме (пользователи этой группы свогут только читать общедоступные сообщения).<br>
- Установите ID второй группы "непроверенные".<br>
- Введите этот ID в плагин Register_FluxBB, активируйте связь и сохраните настройки.
<br>
<b class="mod"><u>Важные замечания:</u></b>
<br>
Если вы уже используете более раннюю версию Register_FluxBB, учетные записи Piwigo, связаны между галереей и FluxBB форумом не будут затронуты последствиями связки. Изменения коснутся только новых пользователей, котроые будут зарегестрированы после активации связки.<b><u>Функция ресинхронизации учетных записей будет считать недействительной.</u></b><br>
Аналогично, если вы никогда не пользовались Register_FluxBB, статус подтвержденных или неподтвержденных учетных записей Piwigo не будет иметь значения во время миграции из галереи на форум FluxBB.';
$lang['error_config_admin1'] = 'ОШИБКА: неверное имя пользователя администратора Piwigo!';
$lang['error_config_admin2'] = 'ОШИБКА: имя учетной записи администратора FluxBB отличается от Piwigo! Проверьте настройки вашего форума FluxBB и переименуйте учетную запись администратора так, чтобы она совпадала с администратором Piwigo.';
$lang['error_config_guest'] = 'ОШИБКА: неверное имя учетной записи гостя FluxBB!';
$lang['About_Bridge_Title'] = 'О Register_FluxBB / UAM саязке';
$lang['About_Bridge_Title_d'] = 'Инструкция о связке между Register_FluxBB и плагином UserAdvManager';
$lang['About_Reg_Title'] = 'О регистрации пользователей на форуме FluxBB';
$lang['About_Reg_Title_d'] = 'Полезные инструкции для лучшей интеграции';
$lang['Config_Title1'] = 'Установка связи между FluxBB и Piwigo';
$lang['Config_Title2'] = 'Расширенные настройки плагина';
$lang['Config_Title_d'] = 'Настройки плагина';
$lang['Instruction_Title'] = 'Инструкции (Сначала прочти!)';
$lang['Instruction_Title_d'] = 'Инструкции и важная информация';
?>