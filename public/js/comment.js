document.getElementById('formCommentID').addEventListener('submit', async (e) => {
  e.preventDefault();
  const content = document.getElementById('commentID').value;
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
