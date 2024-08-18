<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Lokasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Lokasi Details</h2>
        <a href="<?= base_url(''); ?>" class="btn btn-secondary mb-3">Back to List</a>
        <a href="<?= base_url('lokasi/edit/'.$lokasi['id']); ?>" class="btn btn-warning mb-3">Edit</a>
        <a href="#" class="btn btn-danger mb-3 delete-btn" data-id="<?= $lokasi['id']; ?>" data-type="lokasi">Delete</a>
        
        <div class="card">
            <div class="card-body">
                <p><strong>ID:</strong> <?= $lokasi['id']; ?></p>
                <p><strong>Nama Lokasi:</strong> <?= $lokasi['namaLokasi']; ?></p>
                <p><strong>Negara:</strong> <?= $lokasi['negara']; ?></p>
                <p><strong>Provinsi:</strong> <?= $lokasi['provinsi']; ?></p>
                <p><strong>Kota:</strong> <?= $lokasi['kota']; ?></p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.delete-btn').on('click', function(e) {
                e.preventDefault(); // Prevent the default action

                var id = $(this).data('id');
                var type = $(this).data('type');

                if (confirm('Are you sure you want to delete this ' + type + '?')) {
                    $.ajax({
                        url: '<?= base_url('api/') ?>' + type + '/' + id,
                        type: 'DELETE',
                        success: function(result) {
                            alert(type.charAt(0).toUpperCase() + type.slice(1) + ' deleted successfully');
                            window.location.href = '<?= base_url('') ?>'; // Redirect to the home page or list page
                        },
                        error: function(xhr, status, error) {
                            alert('Failed to delete ' + type);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
