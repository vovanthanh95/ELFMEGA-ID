@extends('clients.main')
@section('content')
<div class="payment-body main_df_bt">
	<section class="bg_title">
		<div class="box-title__text text-center">giftcode</div>
	</section>
	<div class="other-function-container">
		<div class="loginmodal-container">
			<div class="conten_login">
				<div class="bk-form-login">
					<form action="giftcode" method="post" novalidate="novalidate">
						<div class="col-md-12">
							<div class="row">
								<input id="code" required autofocus autocomplete="off" name="code" type="text" value="">
								<label for="code" alt="giftcode'" placeholder="giftcode"></label>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row">
								<div id="charList">
									<select class="select-list" name="rid" id="rid"></select>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row">
								<input style="width:50%" id="captcha" required placeholder="captcha" autocomplete="off" name="captcha" type="text" value="">
								<a href="javascript:changeCaptcha();" id="refreshCaptcha">
									{!!captcha_img()!!}
								</a>
								<label for="captcha" alt="captcha" placeholder="captcha"></label>
							</div>
						</div>

						<div class="col-md-12 col-xs-12 col-sm-12">
							<div class="row">
								<div class="col-md-12 col-xs-12 col-sm-12">
									<div class="row">
										<input type="submit" name="giftcode" class="login loginmodal-submit pull-left col-md-12" value="redeemgiftcode">
									</div>
								</div>
							</div>
						</div>
						<input name="return_url" type="hidden" id="return_url" value="">
					</form>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<style>
		.payment-body {
			display: flex;
			align-items: flex-start;
			justify-content: center;
		}

		.bk-loading {
			text-align: center;
			display: none;
		}

		.biometric-box {
			display: none;
		}
	</style>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		loadRole();
	});

	function loadRole() {
		$("#rid option").remove();
		$.post("ajax/ajax-role.php", "", function(result) {
			if (result == null) {
				$("#charList").show();
				$("#rid").append("<option>pleasechooseacharacter</option>");
			} else {
				var items = result['items'];
				if (items.length > 0) {
					var itemResult = "";
					$("#rid").append("<option>pleasechooseacharacter</option>");
					items.forEach(function(entry) {
						var res = entry.split("|");
						if (res[0] != "") {
							$("#charList").show();
							$('#rid').append('<option value="' + res[0] + '">' + res[2] + '</option>');
						} else {
							$("#charList").show();
						}
					});

				} else {
					$("#charList").show();
					$("#rid").append("<option>pleasechooseacharacter</option>");
				}
			}
		}, 'json');
	}
</script>
@endsection
