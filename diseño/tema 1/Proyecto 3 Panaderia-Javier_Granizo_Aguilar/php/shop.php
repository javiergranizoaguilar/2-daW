
<main class="shop">
    <article>
        <div class="wrapper">
            <h1 class="title">Carrito de Compras</h1>
            
            <div class="shop-container">
                <div class="table-container">
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
                            <tr class="row">
                                <td class="cell">
                                    <img src="../imgs/panes/centeno.png" alt="Baguette Francesa" class="product-img">
                                    <div class="product-info">
                                        <h4 class="product-name">Baguette Francesa</h4>
                                        <p class="product-desc">Pan crujiente artesanal</p>
                                    </div>
                                </td>
                                <td class="price">€2.50</td>
                                <td class="quantity">
                                    <input type="number" class="quantity-input" value="2" min="1">
                                </td>
                                <td class="subtotal">€5.00</td>
                                <td class="action">
                                    <button class="remove-btn">❌</button>
                                </td>
                            </tr>

                            <tr class="row">
                                <td class="cell">
                                    <img src="../imgs/panes/integral.png" alt="Pan Integral con Semillas" class="product-img">
                                    <div class="product-info">
                                        <h4 class="product-name">Pan Integral con Semillas</h4>
                                        <p class="product-desc">Nutritivo y delicioso</p>
                                    </div>
                                </td>
                                <td class="price">€2.80</td>
                                <td class="quantity">
                                    <input type="number" class="quantity-input" value="1" min="1">
                                </td>
                                <td class="subtotal">€2.80</td>
                                <td class="action">
                                    <button class="remove-btn">❌</button>
                                </td>
                            </tr>

                            <tr class="row">
                                <td class="cell">
                                    <img src="../imgs/panes/croisan.webp" alt="Cruasán Mantequilla" class="product-img">
                                    <div class="product-info">
                                        <h4 class="product-name">Cruasán Mantequilla</h4>
                                        <p class="product-desc">Desayuno delicioso</p>
                                    </div>
                                </td>
                                <td class="price">€1.50</td>
                                <td class="quantity">
                                    <input type="number" class="quantity-input" value="3" min="1">
                                </td>
                                <td class="subtotal">€4.50</td>
                                <td class="action">
                                    <button class="remove-btn">❌</button>
                                </td>
                            </tr>

                            <tr class="row">
                                <td class="cell">
                                    <img src="../imgs/panes/apple_pie.webp" alt="Tarta de Manzana Artesanal" class="product-img">
                                    <div class="product-info">
                                        <h4 class="product-name">Tarta de Chocolate Artesanal</h4>
                                        <p class="product-desc">Para celebraciones especiales</p>
                                    </div>
                                </td>
                                <td class="price">€18.00</td>
                                <td class="quantity">
                                    <input type="number" class="quantity-input" value="1" min="1">
                                </td>
                                <td class="subtotal">€18.00</td>
                                <td class="action">
                                    <button class="remove-btn">❌</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <aside class="summary">
                    <h2 class="summary-title">Resumen de Compra</h2>
                    
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span>€30.30</span>
                    </div>

                    <div class="summary-row">
                        <span>Envío (24-48h):</span>
                        <span>€3.50</span>
                    </div>

                    <div class="summary-row">
                        <label for="coupon">Código Descuento:</label>
                        <input type="text" id="coupon" placeholder="Ingresa tu código">
                    </div>

                    <div class="summary-row">
                        <span>Descuento:</span>
                        <span>-€0.00</span>
                    </div>

                    <hr>

                    <div class="summary-row summary-total">
                        <span>Total:</span>
                        <span>€33.80</span>
                    </div>

                    <div class="delivery-info">
                        <h3>📦 Información de Entrega</h3>
                        <p>Entregaremos tu pedido en <strong>24-48 horas</strong> en el municipio.</p>
                        <p>Dirección de envío: <strong>C/ Magnolia 12, 28000 Madrid</strong></p>
                    </div>

                    <div class="summary-actions">
                        <a href="./index.php?page=product">Seguir Comprando</a>
                        <button class="btn-submit" id="openButton">Proceder al Pago</button>
                    </div>
                </aside>
            </div>

            <div class="options">
                <h2 class="options-title">Opciones Especiales</h2>
                <div class="options-grid">
                    <div class="option-card">
                        <h3 class="option-heading">🎁 Empaquetado de Regalo</h3>
                        <p class="option-description">Empaques nuestros productos elegantemente para un regalo especial</p>
                        <p class="option-price">+€2.00</p>
                        <input type="checkbox" class="option-checkbox">
                    </div>

                    <div class="option-card">
                        <h3 class="option-heading">🎉 Tarjeta Personalizada</h3>
                        <p class="option-description">Añade una tarjeta con tu mensaje</p>
                        <p class="option-price">+€1.50</p>
                        <input type="checkbox" class="option-checkbox">
                    </div>

                    <div class="option-card">
                        <h3 class="option-heading">📅 Programar Entrega</h3>
                        <p class="option-description">Elige la fecha exacta de entrega</p>
                        <p class="option-price">Gratis</p>
                        <input type="date" class="option-date">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-overlay" id="popup">
            <div class="modal-content">
                <div class="shop-payment">
                    <h2 class="shop-payment-title">Métodos de Pago Disponibles</h2>
                    <div class="shop-payment-methods">
                    <div class="shop-payment-option">
                        <input type="radio" id="payment-card" name="payment" class="shop-payment-input" checked>
                        <label for="payment-card" class="shop-payment-label">💳 Tarjeta de Crédito/Débito</label>
                    </div>
                    <div class="shop-payment-option">
                        <input type="radio" id="payment-transfer" name="payment" class="shop-payment-input">
                        <label for="payment-transfer" class="shop-payment-label">🏦 Transferencia Bancaria</label>
                    </div>
                    <div class="shop-payment-option">
                        <input type="radio" id="payment-paypal" name="payment" class="shop-payment-input">
                        <label for="payment-paypal" class="shop-payment-label">🔵 PayPal</label>
                    </div>
                    <div class="shop-payment-option">
                        <input type="radio" id="payment-cash" name="payment" class="shop-payment-input">
                        <label for="payment-cash" class="shop-payment-label">💵 Efectivo en Tienda</label>
                    </div>
                </div>
                </div>
                <div class="shop-billing">
                    <h2 class="shop-billing-title">Datos de Facturación</h2>
                    <form method="post" class="shop-billing-form" id="billing-form">
                        <div class="shop-form-group">
                            <label class="shop-form-label" for="full-name">Nombre Completo *</label>
                            <input type="text" class="shop-form-input" id="full-name" >
                        </div>

                        <div class="shop-form-group">
                            <label class="shop-form-label" for="email">Email *</label>
                            <input type="email" class="shop-form-input" id="email" >
                        </div>

                        <div class="shop-form-group">
                            <label class="shop-form-label" for="phone">Teléfono *</label>
                            <input type="tel" class="shop-form-input" id="phone" >
                        </div>

                        <div class="shop-form-group">
                            <label class="shop-form-label" for="address">Dirección *</label>
                            <input type="text" class="shop-form-input" id="address" >
                        </div>

                        <div class="shop-form-group">
                            <label class="shop-form-label" for="city">Ciudad *</label>
                            <input type="text" class="shop-form-input" id="city" >
                        </div>

                        <div class="shop-form-group">
                            <label class="shop-form-label" for="zip-code">Código Postal *</label>
                            <input type="text" class="shop-form-input" id="zip-code" >
                        </div>

                        <div class="shop-form-group">
                            <label class="shop-form-label" for="notes">Notas Especiales</label>
                            <textarea class="shop-form-textarea" id="notes" rows="3" placeholder="Ej: Alergias, preferencias especiales..."></textarea>
                        </div>

                        <div class="shop-form-group-checkbox">
                            <input type="checkbox" class="shop-form-checkbox" id="terms-conditions" required>
                            <label class="shop-form-checkbox-label" for="terms-conditions">Acepto los términos y condiciones de compra</label>
                        </div>

                        <div class="shop-form-group-checkbox">
                            <input type="checkbox" class="shop-form-checkbox" id="special-offers">
                            <label class="shop-form-checkbox-label" for="special-offers">Deseo recibir información sobre ofertas especiales</label>
                        </div>

                        <input type="submit" class="shop-form-submit-button" id="submit-button" value="Realizar Pedido">
                    </form>
                </div>
                <button class="modal-close-button" id="outButton">❌</button>
            </div>
        </div>
    </article>

</main>
