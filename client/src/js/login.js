$('#login-btn').on('click', function (event) {
	event.preventDefault();
	var username = $('#username').val();
	var pass = $('#pass').val();
	console.log(username);
	var url = 'https://testing1.thestrategybook.com/deepak-ecommerce/server/api/admin/login.php?user=' + username + '&pass=' + pass;
	if (username && pass) {
		$.ajax({
			url: url,
			type: 'GET',
			crossDomain: true,
			headers: {
				accept: 'text/html; charset=UTF-8',
				'Access-Control-Allow-Headers': 'Origin, X-Requested-With, Content-Type, Accept',
				'Access-Control-Allow-Origin': '*',
			},
			options: {
				mode: 'no-cors',
			},
			success: function (response) {
				console.log(response);
				console.log(response.status);
				var r = JSON.parse(response);
				console.log(r.status);
				localStorage.setItem('status', r.status);
				localStorage.setItem('role', r.role);
				localStorage.setItem('user', username);
				location.replace('https://harshgoel05.github.io/deepak-ecommerce/client/adminportal.html');
			},
			error: function (xhr, status) {
				console.log('error', xhr, status);
				alert('Some unknown error occured');
			},
		});
	} else {
		alert('Please enter all the details');
	}
});
// FrontDesk => Add client, Trainer ( employee, time)
// Admin => All menus

$('#logout-btn').click(function (e) {

    e.preventDefault();
    var url = 'https://testing1.thestrategybook.com/deepak-ecommerce/server/api/logout.php'

    $.ajax({
        url: url,
        type: 'GET',
        crossDomain: true,
        headers: {
            accept: 'text/html; charset=UTF-8',
            'Access-Control-Allow-Headers': 'Origin, X-Requested-With, Content-Type, Accept',
            'Access-Control-Allow-Origin': '*',
        },
        options: {
            mode: 'no-cors',
        },
        success: function (response) {
            localStorage.removeItem('status');
            localStorage.removeItem('role');
            localStorage.removeItem('user');
            location.replace('https://harshgoel05.github.io/deepak-ecommerce/client/login.html');
        },
        error: function (xhr, status) {
            console.log('error', xhr, status);
            alert('Some unknown error occured');
        },
    });

});