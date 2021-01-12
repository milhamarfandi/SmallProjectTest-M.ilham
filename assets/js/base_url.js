function baseurl() {
	var pathparts = location.pathname.split("/");
	// if (location.host == '188.166.212.76') {
	// if (location.host == 'localhost') {
	var base_url = location.origin + "/" + pathparts[1].trim("/"); // http://localhost/myproject/
	// } else {
	//     var base_url = location.origin; //http://localhost/
	// }

	return base_url;
}
