 document.querySelectorAll('.book').forEach(book => {
  book.addEventListener('click', () => {
    book.classList.add('float');
    setTimeout(() => book.classList.add('show-cover'), 500);
    setTimeout(() => book.classList.add('open'), 1200);
    setTimeout(() => {
      window.location.href = `view_story.php?storyId=${book.dataset.storyId}`;
    }, 2500);
  });
});
