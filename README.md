moodle-assignment-service
=========================

XMLRPC-служба для обновления текста заданий (модуль assign) в Мудле, написана с 
использованием API Мудла, предназначенного для создания такого рода служб
(класс `external_api` из `$CFG->libdir . "/externallib.php"` и проч.).

Если загрузить zip-файл с каталогом `ws_assign` (вероятно, нужно удалить
из архива `README.md`), то получится дистрибутив службы,
который можно устанавливать штатными средствами Мудла через его веб-интерфейс.

Пример клиента данной службы на Питоне содержится в репозитории
[moodle-assignment-client](https://github.com/ulysses4ever/moodle-assignment-client).
