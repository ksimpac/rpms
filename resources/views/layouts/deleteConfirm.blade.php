<script>
    document.querySelectorAll('.delete-confirm').forEach(function(node) {
        node.addEventListener('click', function(event) {
            event.preventDefault();
            const form = this.parentElement;
            swal.fire({
                title: @if(Auth::user()->is_admin === 1) '您確定要執行刪除?' @else '您確定要刪除此筆資料?' @endif,
                text: '刪除後將無法復原！',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '刪除',
                cancelButtonText: '取消'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
