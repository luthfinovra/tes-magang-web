<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Lokasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Create New Lokasi</h2>
        <form id="createLokasiForm">
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
            <button type="submit" class="btn btn-primary">Create Lokasi</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        document.getElementById('createLokasiForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            const formData = {
                namaLokasi: document.getElementById('namaLokasi').value,
                negara: document.getElementById('negara').value,
                provinsi: document.getElementById('provinsi').value,
                kota: document.getElementById('kota').value
            };
            
            fetch('http://localhost:8080/api/lokasi', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.message === "Lokasi has been created successfully") {
                    window.location.href = 'http://localhost/web_magang_ci3/';
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>

</body>
</html>
