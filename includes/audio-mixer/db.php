<?php
	$link = mysqli_connect( "localhost", "slides", "nwGQe2CNdr5LFYYt", "beats" );

	/* check connection */
	if( mysqli_connect_errno(  ) ) {
		printf( "Connect failed: %s\n", mysqli_connect_error(  ) );
		
		exit(  );
	}
?>