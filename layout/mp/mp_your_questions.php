<div class="fullwidth-section full-man">
	<div class="container">
		<div class="dt-sc-one-half column first animate" data-animation="fadeInUp" data-delay="100">
			<h3 class="section-title">Есть вопросы? Спроси экспертов проекта</h3>
			<div id="ajax_contact_msg"></div>
			<form name="frmcontact" action="php/send.php" method="post" id="contact-form">
				<div class="dt-sc-one-half column first">
					<input type="text" name="txtname" placeholder="Введи имя..." required>
				</div>
				<div class="dt-sc-one-half column">
					<input type="email" name="txtemail" placeholder="Введи email..." required>
				</div>
				<div class="clear"></div>
				<div class="selection-box">
					<select name="cmbsubject">
						<option value="Ask a Question?">Общий вопрос?</option>
						<option value="What are all benefits of Gym?">Как я получу призы?</option>
						<option value="What are the types of Gym?">Зачем выбирать Жюри?</option>
					</select>
				</div>
				<textarea name="txtmessage" placeholder="Тип твоего вопроса..." required></textarea>
				<input type="submit" name="submit" value="Отправить">
			</form>
		</div>
		<div class="dt-sc-one-half column">
			<img src="images/sharapova_bg.png" alt="" title="" class="aligncenter">
		</div>
	</div>
</div>