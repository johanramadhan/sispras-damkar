<script>
  @if (session('success'))
      Swal.fire({
      position: 'center',
      icon: 'success',
      title: '{{ session('success') }}',
      showConfirmButton: false,
      timer: 1500
    })
  @endif

  @if (session('update'))
      Swal.fire({
      position: 'center',
      icon: 'success',
      title: '{{ session('update') }}',
      showConfirmButton: false,
      timer: 1500
    })
  @endif
</script>