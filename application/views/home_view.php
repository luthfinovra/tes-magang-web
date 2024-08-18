<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <!-- TO DO Pagination -->
    <div class="container mt-5">
        <h2>Data Proyek</h2>
        <a href="<?= base_url('proyek/create'); ?>" class="btn btn-primary mb-3">Create New Proyek</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Proyek</th>
                    <th>Client</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($proyek as $p): ?>
                <tr>
                    <td><?= $p['id']; ?></td>
                    <td><?= $p['namaProyek']; ?></td>
                    <td><?= $p['client']; ?></td>
                    <td>
                        <?php
                        $tglMulai = new DateTime($p['tglMulai']);
                        echo $tglMulai->format('Y-m-d');
                        ?>
                    </td>
                    <td>
                        <?php
                        $tglSelesai = new DateTime($p['tglSelesai']);
                        echo $tglSelesai->format('Y-m-d');
                        ?>
                    </td>
                    <td>
                        <a href="<?= base_url('proyek/'.$p['id']); ?>" class="badge badge-info">Show</a>
                        <a href="<?= base_url('proyek/edit/'.$p['id']); ?>" class="badge badge-warning">Edit</a>
                        <a href="#" class="badge badge-danger delete-btn" data-id="<?= $p['id']; ?>" data-type="proyek">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Data Lokasi</h2>
        <a href="<?= base_url('lokasi/create'); ?>" class="btn btn-primary mb-3">Create New Lokasi</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Lokasi</th>
                    <th>Negara</th>
                    <th>Provinsi</th>
                    <th>Kota</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($lokasi as $l): ?>
                <tr>
                    <td><?= $l['id']; ?></td>
                    <td><?= $l['namaLokasi']; ?></td>
                    <td><?= $l['negara']; ?></td>
                    <td><?= $l['provinsi']; ?></td>
                    <td><?= $l['kota']; ?></td>
                    <td>
                        <a href="<?= base_url('lokasi/'.$l['id']); ?>" class="badge badge-info">Show</a>
                        <a href="<?= base_url('lokasi/edit/'.$l['id']); ?>" class="badge badge-warning">Edit</a>
                        <a href="#" class="badge badge-danger delete-btn" data-id="<?= $l['id']; ?>" data-type="lokasi">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>    
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
                            location.reload(); // Reload the page to reflect changes
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
