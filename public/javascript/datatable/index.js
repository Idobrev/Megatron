function loadDataTable(){
	//$('#dt').DataTable();
	 $('#dt').DataTable( {
        "ajax": "http://localhost/FreeSpot/Megatron/restAPI/getDataTableSpots",
        "columns": [
            { "data": "Name" },
            { "data": "Password" },
            { "data": "Latitude" },
            { "data": "Longtitude" }
        ]
    } );
    $('#datatable').show();
}
//function calls
loadDataTable();