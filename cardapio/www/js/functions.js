function errorCallBack(e) {
    alert("Erro: " + e);
    exit();
}

function successCallBack() {
    return;
}

function nullCallBack() {
    return;
}

function exit() {
    navigator.app.exitApp();
}

function goPage(page) {
    location.href = page;
}

function callWaiter() {

    db.transaction(function(transaction) {
        transaction.executeSql('SELECT * FROM Config', [], function(transaction, result) {
            $.post(BASE_URL + 'receive/setchamado',
                    {
                        device_id: result.rows.item(0)['DeviceId']
                    },
            function(data) {
                alert(data);
            }).fail(function() {
                alert("Não foi possível chamar o Garçom! Tente novamente mais tarde.");
            });
        }, errorCallBack);
    }, errorCallBack, successCallBack);

}