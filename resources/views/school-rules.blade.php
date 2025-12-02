{{-- resources/views/school-rules.blade.php --}}
<x-layout :pageTitle="'School Rules'">
  <div class="soft-card">
    <div class="section-title">School Rules</div>
    <p class="muted-sm mt-2">We expect students to follow these guidelines to create a respectful and productive online learning environment.</p>

    <ul class="mt-3">
      <li><strong>Be on time:</strong> Join class early or on time.</li>
      <li><strong>Camera on:</strong> Keep your camera open during class unless the teacher allows otherwise.</li>
      <li><strong>Use real name:</strong> Display your real name (e.g., Ester_Grade4).</li>
      <li><strong>Chat responsibly:</strong> Use chat only for relevant questions and polite comments.</li>
      <li><strong>Dress appropriately:</strong> Dress neatly and comfortably for class.</li>
      <li><strong>No eating during sessions:</strong> Avoid eating during class, chapel, or flag ceremony sessions out of respect.</li>
    </ul>

    <div class="mt-3">
      <a class="btn btn-primary-accent" href="{{ url('/') }}">Back to Home</a>
    </div>
  </div>
</x-layout>
