<!-- resources/views/speed-test.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Network Speed Test</title>

    <!-- Pastikan tag csrf-token ditambahkan -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Network Speed Test</h1>

    <form id="speedTestForm">
        <label for="ipAddress">IP Address:</label>
        <input type="text" id="ipAddress" name="ip" required>
        <button type="button" onclick="measureSpeed()">Measure Speed</button>
    </form>

    <div id="resultContainer"></div>

    <script>
        function measureSpeed() {
            var ipAddress = document.getElementById('ipAddress').value;

            // Kirim permintaan AJAX ke server untuk melakukan pengukuran kecepatan
            fetch('/measure-speed', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ ip: ipAddress }),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                displayResult(data);
            })
            .catch(error => {
                console.error('Error:', error.message);
                var resultContainer = document.getElementById('resultContainer');
                resultContainer.innerHTML = `<p>Error: ${error.message}</p>`;
            });
        }

        function displayResult(data) {
            var resultContainer = document.getElementById('resultContainer');
            
            // Clear previous content
            resultContainer.innerHTML = '';

            // Add new content
            resultContainer.innerHTML += `<p>Testing IP: ${data.ip}</p>`;
            resultContainer.innerHTML += `<p>Status: ${data.status === 0 ? 'Success' : 'Failed'}</p>`;

            // Check if data.output is defined and is an array before calling join
            if (Array.isArray(data.output)) {
                resultContainer.innerHTML += `<pre>${data.output.join('\n')}</pre>`;

                // Menambahkan indikator warna berdasarkan kecepatan
                var speedIndicator = getSpeedIndicator(data.output);
                resultContainer.innerHTML += `<div style="background-color: ${speedIndicator.color}; width: 50px; height: 50px;"></div>`;
            } else {
                resultContainer.innerHTML += `<p>No output data available</p>`;
            }
        }

        // Atur interval untuk melakukan pengukuran setiap detik
        setInterval(function() {
            measureSpeed();
        }, 1000);

        // Fungsi untuk mendapatkan indikator warna berdasarkan kecepatan
        function getSpeedIndicator(output) {
            // Misalnya, tentukan batasan kecepatan untuk masing-masing warna
            var redLimit = 100;  // Kecepatan merah (dalam milidetik)
            var yellowLimit = 200;  // Kecepatan kuning (dalam milidetik)

            // Ambil RTT dari output ping (contoh: menggunakan nilai ke-9, disesuaikan dengan output ping Anda)
            var rtt = parseInt(output[2].split(' ')[9]);

            // Tentukan warna berdasarkan RTT
            var color = 'green';  // Default: Hijau

            if (rtt > redLimit) {
                color = 'red';
            } else if (rtt > yellowLimit) {
                color = 'yellow';
            }

            return { color: color, rtt: rtt };
        }
    </script>
</body>
</html>
