<div class="home">
	<div class="titulo">
		<?php echo $this->Html->image('aba.png', array('alt' => 'Fmc')); ?><h2>Participe da campanha</h2>
	</div>
	<div class="form-participe">
		<h3>Chegou a hora de partir para o ataque e preencher o formulário que pode garantir a você um lugar no camarote VIP da FMC no Campeonato Mundial. Insira o código que você recebeu, complete com seus dados e parta para o abraço. Boa sorte!
	    </h3>
		<form>
			<p><label>Nome</label><input type="text" name="nome"></p>
			<p><label></label></p>
			<p><label>Email</label><input type="text" name="email"></p>
			<p><label></label></p>
			<p><label>Revenda</label><input type="text" name="revenda"></p>
			<p><label></label></p>
			<p><label>Cidade</label><input type="text" name="cidade"></p>
			<p><label></label></p>
			<p><label>Endereço</label><input type="text" name="endereco"></p>
			<p><label></label></p>
			<p><label>Telefone</label><input type="text" name="telefone"></p>
			<p><label></label></p>
			<div><label>Foto</label>
                <div id="div-input-file">
            		<input name="file-original" type="file" size="30" id="file-original" onchange="document.getElementById('file-falso').value = this.value;"/>
            		<div id="div-input-falso">
                    	<input name="file-falso" type="text" id="file-falso" />
                    </div>
        		</div>
            </div>
			<p><label></label></p>
			<p><label>Código</label><input type="text" name="cpdigo"></p>
			<p><label></label></p>
			<p><label>Senha</label><input type="text" name="senha"></p>
			<p><label></label></p>
			<p><label>Confirmar Senha</label><input type="text" name="senha"></p>
			<p><label></label></p>
			<p class="bt"><input type="reset" value="Limpar"><input type="submit" value="Enviar"></p>	
		</form>
	</div>
</div>

