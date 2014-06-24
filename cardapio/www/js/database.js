var db;
var shortName = 'WebSqlDB';
var version = '1.0';
var displayName = 'WebSqlDB';
var maxSize = 65535;

if (!window.openDatabase) {
    alert('Conexão a base de dados local não estabelecida!');
    exit();
} else {
    db = openDatabase(shortName, version, displayName, maxSize);
}
