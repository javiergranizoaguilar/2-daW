
<main>
    <article>
        <div>
            <h1>Carrito de Compras</h1>
            
            <div>
                <div>
                    <table>
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio Unitario</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Producto 1 -->
                            <tr>
                                <td>
                                    <img src="../imgs/logo.webp" alt="Baguette Francesa">
                                    <div>
                                        <h4>Baguette Francesa</h4>
                                        <p>Pan crujiente artesanal</p>
                                    </div>
                                </td>
                                <td>€2.50</td>
                                <td>
                                    <input type="number" value="2" min="1">
                                </td>
                                <td>€5.00</td>
                                <td>
                                    <button>❌</button>
                                </td>
                            </tr>

                            <!-- Producto 2 -->
                            <tr>
                                <td>
                                    <img src="../imgs/logo.webp" alt="Pan Integral con Semillas">
                                    <div>
                                        <h4>Pan Integral con Semillas</h4>
                                        <p>Nutritivo y delicioso</p>
                                    </div>
                                </td>
                                <td>€2.80</td>
                                <td>
                                    <input type="number" value="1" min="1">
                                </td>
                                <td>€2.80</td>
                                <td>
                                    <button>❌</button>
                                </td>
                            </tr>

                            <!-- Producto 3 -->
                            <tr>
                                <td>
                                    <img src="../imgs/logo.webp" alt="Cruasán Mantequilla">
                                    <div>
                                        <h4>Cruasán Mantequilla</h4>
                                        <p>Desayuno delicioso</p>
                                    </div>
                                </td>
                                <td>€1.50</td>
                                <td>
                                    <input type="number" value="3" min="1">
                                </td>
                                <td>€4.50</td>
                                <td>
                                    <button>❌</button>
                                </td>
                            </tr>

                            <!-- Producto 4 -->
                            <tr>
                                <td>
                                    <img src="../imgs/logo.webp" alt="Tarta de Chocolate Artesanal">
                                    <div>
                                        <h4>Tarta de Chocolate Artesanal</h4>
                                        <p>Para celebraciones especiales</p>
                                    </div>
                                </td>
                                <td>€18.00</td>
                                <td>
                                    <input type="number" value="1" min="1">
                                </td>
                                <td>€18.00</td>
                                <td>
                                    <button>❌</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Resumen de Compra -->
                <aside>
                    <h2>Resumen de Compra</h2>
                    
                    <div>
                        <span>Subtotal:</span>
                        <span>€30.30</span>
                    </div>

                    <div>
                        <span>Envío (24-48h):</span>
                        <span>€3.50</span>
                    </div>

                    <div>
                        <label for="coupon">Código Descuento:</label>
                        <input type="text" placeholder="Ingresa tu código">
                    </div>

                    <div>
                        <span>Descuento:</span>
                        <span>-€0.00</span>
                    </div>

                    <hr>

                    <div>
                        <span>Total:</span>
                        <span>€33.80</span>
                    </div>

                    <div>
                        <h3>📦 Información de Entrega</h3>
                        <p>Entregaremos tu pedido en <strong>24-48 horas</strong> en el municipio.</p>
                        <p>Dirección de envío: <strong>C/ Magnolia 12, 28000 Madrid</strong></p>
                    </div>

                    <div>
                        <a href="shop.php">Seguir Comprando</a>
                        <button>Proceder al Pago</button>
                    </div>
                </aside>
            </div>

            <!-- Opciones Adicionales -->
            <div>
                <h2>Opciones Especiales</h2>
                <div>
                    <div>
                        <h3>🎁 Empaquetado de Regalo</h3>
                        <p>Empaques nuestros productos elegantemente para un regalo especial</p>
                        <p>+€2.00</p>
                        <input type="checkbox">
                    </div>

                    <div>
                        <h3>🎉 Tarjeta Personalizada</h3>
                        <p>Añade una tarjeta con tu mensaje</p>
                        <p>+€1.50</p>
                        <input type="checkbox">
                    </div>

                    <div>
                        <h3>📅 Programar Entrega</h3>
                        <p>Elige la fecha exacta de entrega</p>
                        <p>Gratis</p>
                        <input type="date">
                    </div>
                </div>
            </div>

            <!-- Información de Pago -->
            <div>
                <h2>Métodos de Pago Disponibles</h2>
                <div>
                    <div>
                        <input type="radio" name="payment" checked>
                        <label>💳 Tarjeta de Crédito/Débito</label>
                    </div>
                    <div>
                        <input type="radio" name="payment">
                        <label>🏦 Transferencia Bancaria</label>
                    </div>
                    <div>
                        <input type="radio" name="payment">
                        <label>🔵 PayPal</label>
                    </div>
                    <div>
                        <input type="radio" name="payment">
                        <label>💵 Efectivo en Tienda</label>
                    </div>
                </div>
            </div>

            <!-- Datos de Facturación -->
            <div>
                <h2>Datos de Facturación</h2>
                <form>
                    <div>
                        <label>Nombre Completo *</label>
                        <input type="text" required>
                    </div>

                    <div>
                        <label>Email *</label>
                        <input type="email" required>
                    </div>

                    <div>
                        <label>Teléfono *</label>
                        <input type="tel" required>
                    </div>

                    <div>
                        <label>Dirección *</label>
                        <input type="text" required>
                    </div>

                    <div>
                        <label>Ciudad *</label>
                        <input type="text" required>
                    </div>

                    <div>
                        <label>Código Postal *</label>
                        <input type="text" required>
                    </div>

                    <div>
                        <label>Notas Especiales</label>
                        <textarea rows="3" placeholder="Ej: Alergias, preferencias especiales..."></textarea>
                    </div>

                    <div>
                        <input type="checkbox" required>
                        <label>Acepto los términos y condiciones de compra</label>
                    </div>

                    <div>
                        <input type="checkbox">
                        <label>Deseo recibir información sobre ofertas especiales</label>
                    </div>
                </form>
            </div>
        </div>
    </article>
</main>
