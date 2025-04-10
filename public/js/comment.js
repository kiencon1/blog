document.getElementById('formCommentID').addEventListener('submit', async (e) => {
  e.preventDefault();
  const content = document.getElementById('commentID').value;
  if (!content) {
    document.getElementById('commentError').innerText = 'You must comment something';
    return;
  }
  const userID = +document.getElementById('userID').value;
  const postID = +document.getElementById('postID').value;

  await fetch('http://localhost/blog/post/comment.php', {
    method: "POST",
    body: JSON.stringify({ postID, userID, content }),
  });
  
  const res = await fetch(`http://localhost/blog/post/comment.php?postID=${postID}`);
  const data = await res.text();
  document.getElementById('commentsID').innerHTML = data;
  document.getElementById('commentID').value = '';
});
