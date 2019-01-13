<?php
include("../../../includes/config.php");
include("../../../includes/functions.php");
if (isset($_POST['category'])) {
    echo $_POST['category'];
}
echo "dfgjhj";

?>


$(document).ready(function () {
  $('.group').hide();
  $('#option1').show();
  $('#category').change(function () {
    $('.group').hide();
    $('#'+$(this).val()).show();
  })
});

<div class="form-group">
                  <label>Choose your choice</label>
                  <select id="category" name="category" class="form-control">
				  <option value="0">Choose option</option>
                    <option value="notification">Notification</option>
                    <option value="examination">Examination</option>
                    <option value="almanac">Almanac</option>
                    <option value="syllabus">Syllabus</option>
                  </select>
                </div>
				<div id="notification" class="group">
				</div>
				<div id="examination" class="group">nogsg</div>
				<div id="almanac" class="group">nogsdgdas</div>
							</div>
						</div>
					</div>