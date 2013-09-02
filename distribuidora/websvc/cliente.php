<html>
	<head>
		<body>
		<center>
			<table>
				<tr>
					<td>
					<form action="sincronicar_cliente.php" method="post">
						<input type="hidden" name="nome" id="nome" />
						<input type="submit" name="enviar" id="enviar" value="Sincronizar Clientes" />
					</form>
					</td>
					<td>
					<form action="sincronicar_fornecedor.php" method="post">
						<input type="hidden" name="nome" id="nome"/>
						<input type="submit" name="enviar" id="enviar" value="Sincronizar Fornecedores" />
					</form>
					</td>
					<td>
					<form action="sincronicar_produto.php" method="post">
						<input type="hidden" name="nome" id="nome" />
						<input type="submit" name="enviar" id="enviar" value="Sincronizar Produtos" />
					</form>
					</td>
				</tr>
			</table>
			</center>
		</body>
	</head>
</html>
