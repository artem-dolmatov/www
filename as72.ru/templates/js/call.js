(function()
{ 
	if (typeof F1call === 'undefined') 
	{
		F1call = {};
		var s = document.createElement('script');
		s.type = 'text/javascript';
		s.async = true; 
		
		F1call.API_BASE = "http://connect.f1call.com"; 
		//F1call.BLOCK_WINDOW = true;
		//F1call.API_BASE = "http://localhost:8000";
		
		s.src = F1call.API_BASE + '/static/api.js';
		var x = document.getElementsByTagName('head')[0];
		x.appendChild(s);
	}
	else
		console.log("F1call is already defined.");
})();