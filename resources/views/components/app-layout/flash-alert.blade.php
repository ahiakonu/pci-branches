<div class="row">
    @if (session()->has('status'))
  
        <script type="text/javascript">
            function massge() {
                Swal.fire(
                    'Good job!',
                    {{ session('success') }},
                    'success'
                );
            }
            window.onload = massge;
        </script>
    @endif
</div>
