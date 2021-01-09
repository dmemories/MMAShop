<?php

  if (isset($this->sweetAlert)) {

    if ($this->sweetAlert['refresh']) {
        echo "<script>
            Swal.fire({
                title: \"". $this->sweetAlert['title'] ."\",
                text: \"". $this->sweetAlert['text'] ."\",
                icon: \"". $this->sweetAlert['type'] ."\",
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            })
            </script>";
    }
    else {
            echo "<script>
            Swal.fire(
              '". $this->sweetAlert['title'] ."',
              '". $this->sweetAlert['text'] ."',
              '". $this->sweetAlert['type'] ."'
            )
            </script>";
    }
  
  }

?>
