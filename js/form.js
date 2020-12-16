document.addEventListener('DOMContentLoaded', () =>{
	document.querySelectorAll('form').forEach(el => {
		el.addEventListener('submit', formSend);
	});

	async function formSend(el) {

		let result = '';
		
		el.preventDefault();

		const formData = new FormData(el.target);

		const response = await fetch('/sendmail.php', {
			method: 'POST',
			body: formData
		});
		
		if (response.ok){
			
			result = await response.text();
						
		} else {

			result = 'Сервер не отвечает. Повторите отправку!';
		}

		

		el.target.reset();
	}

});		