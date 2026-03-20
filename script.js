document.addEventListener("DOMContentLoaded", () =>
{
    /*Get Feed from DOM*/
    const feedElement = document.getElementById('feed');

    const loadPosts = async () =>
    {
        try
        {
            /*Get files from list.php*/
            const response = await fetch('list.php');
            const files = await response.json();

            /*Handle case where no images are yet uploaded*/
            if (files.length === 0)
            {
                feedElement.innerHTML = '<p style="text-align:center; width:100%;">No posts yet. Be the first!</p>';
                return;
            }

            /*Loop each file and create posts*/
            files.forEach(filename =>
            {
                /*Create div for each post*/
                const postCard = document.createElement('div');
                postCard.className = 'post';

                /*Create innerHTML for post*/
                postCard.innerHTML = 
                `
                    <img src="uploads/${filename}" 
                         alt="Social Post" 
                         onerror="this.src=''">
                    <div class="post-info">
                        Uploaded: <a href="uploads/${filename}">${filename}</a>
                    </div>
                `;

                feedElement.appendChild(postCard); /*Send to feed*/
            });
            
        } 
        catch (error)
        {
            console.error("Skill issue: cant load feed", error);
            feedElement.innerHTML = '<p style="color:red; text-align:center;">Failed to load feed.</p>';
        }
    };

    loadPosts(); /*Run the func*/
});