function obtener_tokens() {

	fetch('https://api-reniec-sunat.vercel.app/api/login', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify({
			username: "reniec",
			password: "reniec",
			remember_me: true
		})
	})
	.then(response => {
		if (!response.ok) {
			// Manejo de errores de autenticación
			if (response.status === 401) {
				localStorage.removeItem('_token');
			}
			throw new Error(`Error ${response.status}: ${response.statusText}`);
		}
		return response.json();
	})
	.then(data => {
		// Guardar el token en localStorage
		localStorage.setItem('_token', data.token);
	})
	.catch(error => {
		console.error('Error en la solicitud:', error);
	});
}

obtener_tokens();
