<!-- resources/views/speedtest.blade.php -->

<html>
<head>
    <title>Speed Test</title>
</head>
<body>
    <h1>Speed Test</h1>

    <button id="runSpeedTest">Run Speed Test</button>

    <script>
        document.getElementById('runSpeedTest').addEventListener('click', function() {
            // Hitung waktu yang dibutuhkan untuk mengunduh data kecil
            var startTime = new Date().getTime();
            var downloadSpeed = 0;

            // Ganti URL dengan URL file atau endpoint yang dapat memberikan respon kecil
            var downloadURL = 'https://example.com/small-file';

            // Buat objek XMLHttpRequest untuk mengunduh file
            var xhr = new XMLHttpRequest();
            xhr.open('GET', downloadURL + '?' + startTime, true);
            xhr.responseType = 'blob';

            xhr.onload = function() {
                var endTime = new Date().getTime();
                var duration = endTime - startTime;

                // Hitung kecepatan unduh (dalam kilobit per detik)
                downloadSpeed = (xhr.response.size * 8) / (duration / 1000) / 1024;

                // Kirim kecepatan unduh ke server Laravel
                fetch('/speed-test', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ download_speed: downloadSpeed })
                })
                .then(response => response.json())
                .then(data => {
                    // Tampilkan hasil kecepatan unduh
                    console.log('Download Speed:', data.download_speed, 'Kbps');
                    alert('Download Speed: ' + data.download_speed + ' Kbps');
                })
                .catch(error => console.error('Error:', error));
            };

            xhr.send();
        });
    </script>
</body>
</html>
