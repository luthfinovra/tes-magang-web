<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Proyek</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 id="form-title">Edit Proyek</h2>
        <form id="proyek-form" action="<?= site_url('proyek/update'); ?>" method="post">
            <input type="hidden" id="proyekId" name="proyekId">
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
            <div class="form-group">
                <label>Lokasi</label>
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
                        <!-- Rows will be added here dynamically -->
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary">Update Proyek</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        // Extract ID from URL
        const path = window.location.pathname;
        const segments = path.split('/');
        const id = segments[segments.length - 1]; // Get the last segment as ID

        if (!id || id === 'null') {
            alert('Invalid ID');
            window.location.href = 'http://localhost/web_magang_ci3/';
            return;
        }

        // Fetch existing data and populate the form
        $.ajax({
            url: `http://localhost:8080/api/proyek/${id}`,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response && response.data) {
                    const proyek = response.data;
                    $('#proyekId').val(proyek.id);
                    $('#namaProyek').val(proyek.namaProyek);
                    $('#client').val(proyek.client);
                    $('#tglMulai').val(proyek.tglMulai.split('T')[0]);
                    $('#tglSelesai').val(proyek.tglSelesai.split('T')[0]);
                    $('#pimpinanProyek').val(proyek.pimpinanProyek);
                    $('#keterangan').val(proyek.keterangan);

                    // Populate lokasi checkboxes
                    $.ajax({
                        url: 'http://localhost:8080/api/lokasi',
                        type: 'GET',
                        dataType: 'json',
                        success: function(lokasiResponse) {
                            if (lokasiResponse.data && Array.isArray(lokasiResponse.data.content)) {
                                var lokasiTableBody = $('#lokasi-table tbody');
                                lokasiTableBody.empty();

                                lokasiResponse.data.content.forEach(function(lokasi) {
                                    var isChecked = proyek.proyekLokasiSet.some(function(pl) {
                                        return pl.lokasi.id === lokasi.id;
                                    });

                                    var row = '<tr>' +
                                              '<td><input type="checkbox" class="lokasi-checkbox" value="' + lokasi.id + '"' + (isChecked ? ' checked' : '') + '></td>' +
                                              '<td>' + lokasi.namaLokasi + '</td>' +
                                              '<td>' + lokasi.negara + '</td>' +
                                              '<td>' + lokasi.provinsi + '</td>' +
                                              '<td>' + lokasi.kota + '</td>' +
                                              '</tr>';
                                    lokasiTableBody.append(row);
                                });
                            } else {
                                console.error('Unexpected lokasi response format:', lokasiResponse);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Failed to fetch lokasi data:', status, error);
                        }
                    });
                } else {
                    alert('Failed to load data');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching proyek data:', status, error);
                alert('Error fetching proyek data');
            }
        });

        // Handle form submission
        $('#proyek-form').on('submit', function(e) {
            e.preventDefault();

            let lokasiIds = [];
            $('.lokasi-checkbox:checked').each(function() {
                lokasiIds.push($(this).val());
            });

            let formData = {
                id: $('#proyekId').val(),
                namaProyek: $('#namaProyek').val(),
                client: $('#client').val(),
                tglMulai: $('#tglMulai').val() + 'T00:00:00',
                tglSelesai: $('#tglSelesai').val() + 'T00:00:00',
                pimpinanProyek: $('#pimpinanProyek').val(),
                keterangan: $('#keterangan').val(),
                lokasiIds: lokasiIds
            };

            $.ajax({
                url: `http://localhost:8080/api/proyek/${id}`,
                method: 'PUT',
                contentType: 'application/json',
                data: JSON.stringify(formData),
                success: function(response) {
                    if (response.status === 200) {
                        alert('Proyek updated successfully!');
                        window.location.href = 'http://localhost/web_magang_ci3/'; // Redirect to the home page
                    } else {
                        alert('Failed to update Proyek');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', status, error);
                    alert('Error updating Proyek');
                }
            });
        });
    });
    </script>
</body>
</html>
