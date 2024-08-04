<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const notyf = new Notyf();
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            notyf.error("{{ $error }}");
            console.log("{{ $error }}")
        @endforeach
    @endif
</script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('body').on('click', '.delete-data', function(event) {
            event.preventDefault();

            let deleteUrl = $(this).attr('href');

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#265df1",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: 'DELETE',
                        url: deleteUrl,
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire(
                                    'Deleted!',
                                    data.message,
                                    'success'
                                ).then(() => {
                                    window.location.reload();
                                })
                            } else if (data.status == 'error') {
                                Swal.fire(
                                    'Cant Delete',
                                    data.message,
                                    'error'
                                )
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    })
                }
            });
        })
    })
</script>
<script>
    $(document).ready(function() {
        $('#submitButton').on('click', function(e) {
            e.preventDefault();
            let formData = $('#prizeBondForm').serializeArray();

            let data = {};
            $.each(formData, function(i, field) {
                data[field.name] = field.value;
            });
            $.ajax({
                url: "{{ route('prize-bond.store') }}",
                type: 'POST',
                data: JSON.stringify(data),
                contentType: 'application/json',
                success: function(response) {
                    notyf.success(response.message);
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;
                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errors[key].forEach(function(error) {
                                    notyf.error(error);
                                });
                            }
                        }
                    }
                }
            });
        });

        $('.cancelButton').on('click', function(e) {
            window.location.reload();
        })
    });
</script>
<script>
    $(document).ready(function() {
        $('#bondsTable').DataTable({
            responsive: true,
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('body').on('click', '.edit-button', function() {
            let id = $(this).data('id');
            let url = '{{ route('prize-bond.show', ':id') }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    $('#prefix-edit').val(response.prefix);
                    $('#serial-edit').val(response.serial);
                    $('#id-hidden').val(response.id);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        })
    })
</script>
<script>
    $(document).ready(function() {
        $('#editButton').on('click', function(e) {
            e.preventDefault();
            let formData = $('#prizeBondEditForm').serializeArray();

            const idValue = formData.find(item => item.name === "id")?.value || null;

            let url = '{{ route('prize-bond.show', ':id') }}'.replace(':id', idValue);

            let data = formData.reduce((obj, item) => {
                obj[item.name] = item.value;
                return obj;
            }, {});

            $.ajax({
                url: url,
                type: 'PUT',
                data: JSON.stringify(data),
                contentType: 'application/json',
                success: function(response) {
                    notyf.success(response.message);
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;
                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errors[key].forEach(function(error) {
                                    notyf.error(error);
                                });
                            }
                        }
                    }
                }
            });
        });
    });
</script>
