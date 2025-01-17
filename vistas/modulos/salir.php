<?php

session_destroy();

echo '<script>	

document.cookie = "logintomadecision=false; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;"

document.cookie = "empresa=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;"

document.cookie = "rememberme=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;"

window.location = "index.php?ruta=inicio"

</script>';

?>