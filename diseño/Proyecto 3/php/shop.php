
<main class="shop-main">
    <article class="shop-article">
        <div class="shop-wrapper">
            <h1 class="shop-title">Carrito de Compras</h1>
            
            <div class="shop-container">
                <div class="shop-table-container">
                    <table class="shop-table">
                        <thead class="shop-table-head">
                            <tr class="shop-table-row">
                                <th class="shop-table-header">Producto</th>
                                <th class="shop-table-header">Precio Unitario</th>
                                <th class="shop-table-header">Cantidad</th>
                                <th class="shop-table-header">Subtotal</th>
                                <th class="shop-table-header">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="shop-table-body">
                            <tr class="shop-product-row">
                                <td class="shop-product-cell">
                                    <img src="../imgs/panes/centeno.png" alt="Baguette Francesa" class="shop-product-image">
                                    <div class="shop-product-info">
                                        <h4 class="shop-product-name">Baguette Francesa</h4>
                                        <p class="shop-product-desc">Pan crujiente artesanal</p>
                                    </div>
                                </td>
                                <td class="shop-product-price">€2.50</td>
                                <td class="shop-product-quantity">
                                    <input type="number" class="shop-quantity-input" value="2" min="1">
                                </td>
                                <td class="shop-product-subtotal">€5.00</td>
                                <td class="shop-product-action">
                                    <button class="shop-remove-btn">❌</button>
                                </td>
                            </tr>

                            <tr class="shop-product-row">
                                <td class="shop-product-cell">
                                    <img src="../imgs/panes/integral.png" alt="Pan Integral con Semillas" class="shop-product-image">
                                    <div class="shop-product-info">
                                        <h4 class="shop-product-name">Pan Integral con Semillas</h4>
                                        <p class="shop-product-desc">Nutritivo y delicioso</p>
                                    </div>
                                </td>
                                <td class="shop-product-price">€2.80</td>
                                <td class="shop-product-quantity">
                                    <input type="number" class="shop-quantity-input" value="1" min="1">
                                </td>
                                <td class="shop-product-subtotal">€2.80</td>
                                <td class="shop-product-action">
                                    <button class="shop-remove-btn">❌</button>
                                </td>
                            </tr>

                            <tr class="shop-product-row">
                                <td class="shop-product-cell">
                                    <img src="../imgs/panes/croisan.webp" alt="Cruasán Mantequilla" class="shop-product-image">
                                    <div class="shop-product-info">
                                        <h4 class="shop-product-name">Cruasán Mantequilla</h4>
                                        <p class="shop-product-desc">Desayuno delicioso</p>
                                    </div>
                                </td>
                                <td class="shop-product-price">€1.50</td>
                                <td class="shop-product-quantity">
                                    <input type="number" class="shop-quantity-input" value="3" min="1">
                                </td>
                                <td class="shop-product-subtotal">€4.50</td>
                                <td class="shop-product-action">
                                    <button class="shop-remove-btn">❌</button>
                                </td>
                            </tr>

                            <tr class="shop-product-row">
                                <td class="shop-product-cell">
                                    <img src="../imgs/panes/apple_pie.webp" alt="Tarta de Manzana Artesanal" class="shop-product-image">
                                    <div class="shop-product-info">
                                        <h4 class="shop-product-name">Tarta de Chocolate Artesanal</h4>
                                        <p class="shop-product-desc">Para celebraciones especiales</p>
                                    </div>
                                </td>
                                <td class="shop-product-price">€18.00</td>
                                <td class="shop-product-quantity">
                                    <input type="number" class="shop-quantity-input" value="1" min="1">
                                </td>
                                <td class="shop-product-subtotal">€18.00</td>
                                <td class="shop-product-action">
                                    <button class="shop-remove-btn">❌</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <aside class="shop-summary">
                    <h2 class="shop-summary-title">Resumen de Compra</h2>
                    
                    <div class="shop-summary-row">
                        <span class="shop-summary-label">Subtotal:</span>
                        <span class="shop-summary-value">€30.30</span>
                    </div>

                    <div class="shop-summary-row">
                        <span class="shop-summary-label">Envío (24-48h):</span>
                        <span class="shop-summary-value">€3.50</span>
                    </div>

                    <div class="shop-summary-row">
                        <label for="coupon" class="shop-summary-label">Código Descuento:</label>
                        <input type="text" id="coupon" class="shop-coupon-input" placeholder="Ingresa tu código">
                    </div>

                    <div class="shop-summary-row">
                        <span class="shop-summary-label">Descuento:</span>
                        <span class="shop-summary-value">-€0.00</span>
                    </div>

                    <hr class="shop-summary-divider">

                    <div class="shop-summary-row shop-summary-total">
                        <span class="shop-summary-label">Total:</span>
                        <span class="shop-summary-value">€33.80</span>
                    </div>

                    <div class="shop-delivery-info">
                        <h3 class="shop-delivery-heading">📦 Información de Entrega</h3>
                        <p class="shop-delivery-text">Entregaremos tu pedido en <strong>24-48 horas</strong> en el municipio.</p>
                        <p class="shop-delivery-text">Dirección de envío: <strong>C/ Magnolia 12, 28000 Madrid</strong></p>
                    </div>

                    <div class="shop-summary-actions">
                        <a href="./index.php?page=product" class="shop-continue-link">Seguir Comprando</a>
                        <button class="shop-checkout-btn">Proceder al Pago</button>
                    </div>
                </aside>
            </div>

            <div class="shop-options">
                <h2 class="shop-options-title">Opciones Especiales</h2>
                <div class="shop-options-grid">
                    <div class="shop-option-card">
                        <h3 class="shop-option-heading">🎁 Empaquetado de Regalo</h3>
                        <p class="shop-option-description">Empaques nuestros productos elegantemente para un regalo especial</p>
                        <p class="shop-option-price">+€2.00</p>
                        <input type="checkbox" class="shop-option-checkbox">
                    </div>

                    <div class="shop-option-card">
                        <h3 class="shop-option-heading">🎉 Tarjeta Personalizada</h3>
                        <p class="shop-option-description">Añade una tarjeta con tu mensaje</p>
                        <p class="shop-option-price">+€1.50</p>
                        <input type="checkbox" class="shop-option-checkbox">
                    </div>

                    <div class="shop-option-card">
                        <h3 class="shop-option-heading">📅 Programar Entrega</h3>
                        <p class="shop-option-description">Elige la fecha exacta de entrega</p>
                        <p class="shop-option-price">Gratis</p>
                        <input type="date" class="shop-option-date">
                    </div>
                </div>
            </div>

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
                <form class="shop-billing-form">
                    <div class="shop-form-group">
                        <label class="shop-form-label">Nombre Completo *</label>
                        <input type="text" class="shop-form-input" required>
                    </div>

                    <div class="shop-form-group">
                        <label class="shop-form-label">Email *</label>
                        <input type="email" class="shop-form-input" required>
                    </div>

                    <div class="shop-form-group">
                        <label class="shop-form-label">Teléfono *</label>
                        <input type="tel" class="shop-form-input" required>
                    </div>

                    <div class="shop-form-group">
                        <label class="shop-form-label">Dirección *</label>
                        <input type="text" class="shop-form-input" required>
                    </div>

                    <div class="shop-form-group">
                        <label class="shop-form-label">Ciudad *</label>
                        <input type="text" class="shop-form-input" required>
                    </div>

                    <div class="shop-form-group">
                        <label class="shop-form-label">Código Postal *</label>
                        <input type="text" class="shop-form-input" required>
                    </div>

                    <div class="shop-form-group">
                        <label class="shop-form-label">Notas Especiales</label>
                        <textarea class="shop-form-textarea" rows="3" placeholder="Ej: Alergias, preferencias especiales..."></textarea>
                    </div>

                    <div class="shop-form-group">
                        <input type="checkbox" class="shop-form-checkbox" required>
                        <label class="shop-form-checkbox-label">Acepto los términos y condiciones de compra</label>
                    </div>

                    <div class="shop-form-group">
                        <input type="checkbox" class="shop-form-checkbox">
                        <label class="shop-form-checkbox-label">Deseo recibir información sobre ofertas especiales</label>
                    </div>
                </form>
            </div>
        </div>
    </article>
</main>
