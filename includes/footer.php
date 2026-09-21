<!-- includes/footer.php -->
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Numanke - Spesial Ayam Brongot. All Rights Reserved.</p>
    </footer>

    <!-- Script Wajib Bootstrap untuk Carousel & Modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script AOS untuk Animasi Scroll -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Mengaktifkan Animasi Scroll
        AOS.init({
            duration: 1000, 
            once: true,     
            offset: 100     
        });

        // Logika untuk menghilangkan Loading Screen saat web selesai dimuat
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            
            if (preloader) {
                // Memberikan sedikit waktu delay agar animasi logonya sempat terlihat
                setTimeout(function() {
                    preloader.classList.add('fade-out');
                    
                    // Menghapus elemen dari HTML setelah animasi memudar selesai
                    setTimeout(() => {
                        preloader.style.display = 'none';
                    }, 800); 
                }, 500); // Tahan layar loading selama 0.5 detik
            }
        });
    </script>
</body>
</html>