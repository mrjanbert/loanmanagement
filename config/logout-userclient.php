<?php
    session_start();
    session_destroy();
    session_start();
    $_SESSION['status']= "<script>const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 5000
                                    })

                                        Toast.fire({
                                        icon: 'success',
                                        title: 'Logged out successfully'
                                    })</script>";
    header('location: ../pages/client/login.php');
    mysqli_close($conn);
?>