   const sidebar = document.getElementById('sidebar');
   const notificationsModal = document.getElementById('notifications-modal');
   const shareModal = document.getElementById('share-modal');

   function toggleSidebar() {
       sidebar.classList.toggle('-translate-x-full');
   }

   function showNotifications() {
       notificationsModal.classList.remove('hidden');
   }

   function hideNotifications() {
       notificationsModal.classList.add('hidden');
   }

   function showShare() {
       shareModal.classList.remove('hidden');
   }

   function hideShare() {
       shareModal.classList.add('hidden');
   }

   function setActiveView(view) {
       document.getElementById('main-content').innerHTML = `<h1 class="text-3xl font-black mb-6">${view.charAt(0).toUpperCase()+view.slice(1)}</h1>`;
       document.querySelectorAll('.nav-item').forEach(item => item.classList.remove('bg-[#e85a3c]', 'text-white', 'shadow-xl', 'scale-105'));
       const navItem = Array.from(document.querySelectorAll('.nav-item')).find(item => item.textContent.toLowerCase().includes(view));
       if (navItem) navItem.classList.add('bg-[#e85a3c]', 'text-white', 'shadow-xl', 'scale-105');
       sidebar.classList.add('-translate-x-full');
   }