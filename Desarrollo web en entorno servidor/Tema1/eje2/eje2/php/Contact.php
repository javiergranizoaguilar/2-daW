<?php include "head.php"; ?>
<?php include "header.php";?>
    <article class="">
        <div class="container">
            <h1 class="main-title">Contacto</h1>
            
            <div class="contact-intro">
                <h2>¡Hablemos de Memes!</h2>
                <p>¿Tienes una idea genial? ¿Quieres colaborar? ¿O simplemente quieres compartir un meme épico? ¡Estamos aquí para escucharte!</p>
            </div>

            <div class="contact-grid">
                <div class="contact-info">
                    <h2>Información de Contacto</h2>
                    <div class="info-items">
                        <div class="info-item">
                            <h3><i class="fas fa-map-marker-alt"></i> Ubicación</h3>
                            <p>Calle de la Risa, 404</p>
                            <p>28000 Madrid, España</p>
                        </div>
                        
                        <div class="info-item">
                            <h3><i class="fas fa-envelope"></i> Email</h3>
                            <p>info@dailymemes.com</p>
                            <p>memes@dailymemes.com</p>
                        </div>
                        
                        <div class="info-item">
                            <h3><i class="fas fa-phone"></i> Teléfono</h3>
                            <p>+34 612 345 678</p>
                            <p>Lun-Vie: 9:00-18:00</p>
                        </div>
                    </div>
                </div>

                <div class="contact-form">
                    <h2>Envíanos un Mensaje</h2>
                    <form class="form-container">
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Asunto:</label>
                            <input type="text" id="subject" name="subject" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Mensaje:</label>
                            <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                    </form>
                </div>
            </div>

            <div class="social-section">
                <h2>Síguenos en Redes Sociales</h2>
                <div class="social-icons">
                    <a href="https://x.com/?lang=es" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.facebook.com/?locale=es_ES" class="social-icon"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.reddit.com/" class="social-icon"><i class="fab fa-reddit"></i></a>
                </div>
            </div>
        </div>
    </article>
<?php include "footer.php" ?>