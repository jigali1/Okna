//document.addEventListener("DOMContentLoaded", () => {
	console.log('123');
	let maskOptions = {
		mask: '+{7}(000)000-00-00',
	}	
	document.getElementsByName('phone').forEach(el => {
		IMask(el, maskOptions);	
	});

	window.addEventListener('scroll', function(){
		let prevScrollPos = window.pageYOffset;
		if (window.pageYOffset < 70) {
			document.querySelector('header').style.top = '0';}
		else {
			document.querySelector('header').style.top = '-200px';
		}
	});	

	document.querySelectorAll('.call-popup').forEach(e => {
		e.addEventListener('click', popup);
	});

	document.querySelectorAll('form').forEach(el => {
		el.addEventListener('submit', formSend);
	});

	const popupWrapper = document.querySelector('.popup-form-wrapper');
	const popupMessage = document.querySelector('.popup-message-wrapper');
	document.querySelector('.popup-form form').onclick = ()=>{
		event.stopPropagation();
	}

	popupWrapper.onclick = ()=>{
		popupWrapper.classList.add('hide');
	}

	popupMessage.onclick = ()=>{
		popupMessage.classList.add('hide');
	}

	function popup() {
		popupWrapper.classList.remove('hide');			
	}

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
		popupWrapper.classList.add('hide');
		document.querySelector("#message").innerHTML = result;
		popupMessage.classList.remove('hide');
	}
//});