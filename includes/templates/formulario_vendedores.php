    <fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="vendedores[nombre]" placeholder="Nombre Vendedor(a)" value="<?php echo s($vendedores->nombre); ?>">

    <label for="apellido">Apellido</label>
    <input type="text" id="apellido" name="vendedores[apellido]" placeholder="Apellido Vendedor(a)" value="<?php echo s($vendedores->apellido); ?>">

    <label for="cedula">Cédula</label>
    <input type="number" id="cedula" name="vendedores[cedula]" placeholder="Cédula Vendedor(a)" value="<?php echo s($vendedores->cedula); ?>">

    <label for="salario">Salario</label>
    <input type="number" id="salario" name="vendedores[salario]" placeholder="Salario Vendedor(a)" value="<?php echo s($vendedores->salario); ?>">

    <label for="comision">Comisión</label>
    <input type="number" id="comision" name="vendedores[comision]" placeholder="Comisión Vendedor(a)" value="<?php echo s($vendedores->comision); ?>">

</fieldset>

<fieldset>
    <legend>Información Extra</legend>

    <label for="telefono">Teléfono</label>
    <input type="text" id="telefono" name="vendedores[telefono]" placeholder="Teléfono Vendedor(a)" value="<?php echo s($vendedores->telefono); ?>">

    <label for="direccion">Dirección</label>
    <input type="text" id="direccion" name="vendedores[direccion]" placeholder="Dirección Vendedor(a)" value="<?php echo s($vendedores->direccion); ?>">

    <label for="email">Correo Electrónico</label>
    <input type="email" id="email" name="vendedores[email]" placeholder="Email Vendedor(a)" value="<?php echo s($vendedores->email); ?>">

    <label for="password">Contraseña</label>
    <input type="password" id="password" name="vendedores[password]" placeholder="Contraseña Vendedor(a)" value="<?php echo s($vendedores->password); ?>">

 
</fieldset> 



