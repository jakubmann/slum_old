<div class='submit-text' style='width: 40%; margin: 0px auto;'>
  <h2 class='submit_text__header'>Submit a text</h2>
  <form class='text-form' method='POST' id='text-form' action='ajax/text.php'>
    <input style='display: block;'
    type='text' name='title' class='text__title' id='title'>
    <textarea rows='20' cols='50' name ='body'class='text__body' id='body'></textarea>
    <button
    style='display: block; border: none; padding: 15px 12px 15px 12px; background-color: red;'
    class="submit_button" type="submit" name="submit">Submit</button>
  </form>
</div>
