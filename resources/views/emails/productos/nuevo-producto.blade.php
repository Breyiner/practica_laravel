<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 10px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 30px;
        }
        .content h2 {
            color: #667eea;
            margin-top: 0;
            font-size: 20px;
        }
        .product-card {
            background: #f9f9f9;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .product-info {
            margin: 10px 0;
        }
        .product-info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .product-info-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .value {
            color: #333;
        }
        .price {
            font-size: 24px;
            color: #28a745;
            font-weight: bold;
        }
        .stock-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }
        .stock-high {
            background-color: #d4edda;
            color: #155724;
        }
        .stock-low {
            background-color: #fff3cd;
            color: #856404;
        }
        .stock-out {
            background-color: #f8d7da;
            color: #721c24;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #667eea;
            color: white !important;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
        }
        .button:hover {
            background-color: #5568d3;
        }
        .footer {
            background-color: #f1f1f1;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .footer a {
            color: #667eea;
            text-decoration: none;
        }
        .divider {
            height: 1px;
            background-color: #e0e0e0;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>🎉 Nuevo Producto Agregado</h1>
            <p>Se ha registrado un nuevo producto en el sistema</p>
        </div>
        
        <!-- Content -->
        <div class="content">
            <h2>Hola, Administrador</h2>
            
            <p>Te informamos que se ha agregado un nuevo producto al catálogo. A continuación los detalles:</p>
            
            <!-- Product Card -->
            <div class="product-card">
                <h3 style="margin-top: 0; color: #333;">{{ $producto->nombre }}</h3>
                
                @if($producto->descripcion)
                    <p style="color: #666; margin: 10px 0;">
                        {{ $producto->descripcion }}
                    </p>
                @endif
                
                <div class="divider"></div>
                
                <div class="product-info">
                    <div class="product-info-row">
                        <span class="label">ID del Producto:</span>
                        <span class="value">#{{ $producto->id }}</span>
                    </div>
                    
                    <div class="product-info-row">
                        <span class="label">Precio:</span>
                        <span class="price">${{ number_format($producto->precio, 2) }}</span>
                    </div>
                    
                    <div class="product-info-row">
                        <span class="label">Stock Inicial:</span>
                        <span class="value">
                            {{ $producto->stock }} unidades
                            @if($producto->stock > 10)
                                <span class="stock-badge stock-high">✓ Suficiente</span>
                            @elseif($producto->stock > 0)
                                <span class="stock-badge stock-low">⚠ Bajo</span>
                            @else
                                <span class="stock-badge stock-out">✗ Agotado</span>
                            @endif
                        </span>
                    </div>
                    
                    @if($producto->categoria)
                        <div class="product-info-row">
                            <span class="label">Categoría:</span>
                            <span class="value">{{ $producto->categoria->nombre }}</span>
                        </div>
                    @endif
                    
                    <div class="product-info-row">
                        <span class="label">Estado:</span>
                        <span class="value">
                            @if($producto->activo)
                                <span style="color: #28a745;">● Activo</span>
                            @else
                                <span style="color: #dc3545;">● Inactivo</span>
                            @endif
                        </span>
                    </div>
                    
                    <div class="product-info-row">
                        <span class="label">Fecha de Registro:</span>
                        <span class="value">{{ $producto->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Action Button -->
            <center>
                <a href="{{ url('/productos/' . $producto->id) }}" class="button">
                    Ver Producto en el Sistema
                </a>
            </center>
            
            <p style="margin-top: 30px; color: #666; font-size: 14px;">
                Este es un correo automático generado por el sistema de gestión de productos.
            </p>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p>
                © {{ date('Y') }} TuApp. Todos los derechos reservados.<br>
                <a href="{{ url('/') }}">Visitar sitio web</a> | 
                <a href="{{ url('/productos') }}">Ver catálogo</a>
            </p>
        </div>
    </div>
</body>
</html>