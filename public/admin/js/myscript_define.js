 $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });

 $("div.alert").delay(5000).slideUp(); // cái này nó hiện ra sau 5 giây và tự động tắt đi (khi thực hiện thêm)

function xacnhanxoa(msg) {
            if (window.confirm(msg)) {
                return true;
            }
            return false;
        }
