<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Proyek</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Create New Proyek</h2>
        <form id="proyek-form" action="<?= site_url('proyek/create'); ?>" method="post">
            <div class="form-group">
                <label for="namaProyek">Nama Proyek</label>
                <input type="text" class="form-control" id="namaProyek" name="namaProyek" required>
            </div>
            <div class="form-group">
                <label for="client">Client</label>
                <input type="text" class="form-control" id="client" name="client" required>
            </div>
            <div class="form-group">
                <label for="tglMulai">Tanggal Mulai</label>
                <input type="date" class="form-control" id="tglMulai" name="tglMulai" required>
            </div>
            <div class="form-group">
                <label for="tglSelesai">Tanggal Selesai</label>
                <input type="date" class="form-control" id="tglSelesai" name="tglSelesai" required>
            </div>
            <div class="form-group">
                <label for="pimpinanProyek">Pimpinan Proyek</label>
                <input type="text" class="form-control" id="pimpinanProyek" name="pimpinanProyek" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
            </div>

            <h3>Lokasi</h3>
            <table id="lokasi-table" class="table">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Nama Lokasi</th>
                        <th>Negara</th>
                        <th>Provinsi</th>
                        <th>Kota</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Lokasi rows will be populated here -->
                </tbody>
            </table>

            <input type="hidden" id="proyekId" name="proyekId" value="0"> <!-- Hidden field for Proyek ID if editing -->

            <button type="submit" class="btn btn-primary">Save Proyek</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
    $(document).ready(function() {
        // Fetch Lokasi data
        $.ajax({
            url: 'http://localhost:8080/api/lokasi', // Your API endpoint
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Check if response contains the expected data structure
                if (response.data && Array.isArray(response.data.content)) {
                    var lokasiTableBody = $('#lokasi-table tbody');
                    lokasiTableBody.empty(); // Clear existing table rows

                    // Iterate over the array of Lokasi objects
                    response.data.content.forEach(function(lokasi) {
                        var row = '<tr>' +
                                  '<td><input type="checkbox" class="lokasi-checkbox" value="' + lokasi.id + '"></td>' +
                                  '<td>' + lokasi.namaLokasi + '</td>' +
                                  '<td>' + lokasi.negara + '</td>' +
                                  '<td>' + lokasi.provinsi + '</td>' +
                                  '<td>' + lokasi.kota + '</td>' +
                                  '</tr>';
                        lokasiTableBody.append(row);
                    });
                } else {
                    console.error('Unexpected response format:', response);
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to fetch data:', status, error);
            }
        });

        // Handle form submission
        $('#proyek-form').on('submit', function(e) {
            e.preventDefault();

            let lokasiIds = [];
            $('.lokasi-checkbox:checked').each(function() {
                lokasiIds.push(parseInt($(this).val(), 10));
            });

            let formData = {
                namaProyek: $('#namaProyek').val(),
                client: $('#client').val(),
                tglMulai: $('#tglMulai').val() + 'T00:00:00',
                tglSelesai: $('#tglSelesai').val() + 'T00:00:00',
                pimpinanProyek: $('#pimpinanProyek').val(),
                keterangan: $('#keterangan').val(),
                lokasiIds: lokasiIds
            };

            let method = 'POST';
            let url = 'http://localhost:8080/api/proyek';

            $.ajax({
                url: url,
                method: method,
                contentType: 'application/json',
                data: JSON.stringify(formData),
                success: function(response) {
                    alert('Proyek saved successfully!');
                    window.location.href = 'http://localhost/web_magang_ci3/';
                },
                error: function(xhr, status, error) {
                    console.error('Error saving Proyek:', status, error);
                    alert('Error saving Proyek');
                }
            });
        });
    });
    </script>
</body>
</html>
