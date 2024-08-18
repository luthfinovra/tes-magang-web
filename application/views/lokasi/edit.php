<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lokasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Lokasi</h2>
        <form id="editLokasiForm">
            <div class="form-group">
                <label for="namaLokasi">Nama Lokasi</label>
                <input type="text" class="form-control" id="namaLokasi" name="namaLokasi" required>
            </div>
            <div class="form-group">
                <label for="negara">Negara</label>
                <input type="text" class="form-control" id="negara" name="negara" required>
            </div>
            <div class="form-group">
                <label for="provinsi">Provinsi</label>
                <input type="text" class="form-control" id="provinsi" name="provinsi" required>
            </div>
            <div class="form-group">
                <label for="kota">Kota</label>
                <input type="text" class="form-control" id="kota" name="kota" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Lokasi</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
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
    fetch(`http://localhost:8080/api/lokasi/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data && data.data) {
                document.getElementById('namaLokasi').value = data.data.namaLokasi || '';
                document.getElementById('negara').value = data.data.negara || '';
                document.getElementById('provinsi').value = data.data.provinsi || '';
                document.getElementById('kota').value = data.data.kota || '';
            } else {
                alert('Failed to load data');
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            alert('Error fetching data');
        });

    // Handle form submission
    document.getElementById('editLokasiForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = {
            namaLokasi: document.getElementById('namaLokasi').value,
            negara: document.getElementById('negara').value,
            provinsi: document.getElementById('provinsi').value,
            kota: document.getElementById('kota').value
        };

        fetch(`http://localhost:8080/api/lokasi/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 200) {
                window.location.href = 'http://localhost/web_magang_ci3/';
            } else {
                alert('Failed to update lokasi');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error updating lokasi');
        });
    });
});
    </script>
</body>
</html>
