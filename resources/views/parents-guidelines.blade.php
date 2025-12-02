{{-- resources/views/parents-guidelines.blade.php --}}
<x-layout :pageTitle="'Parents Guidelines'">
  <div class="soft-card">
    <div class="section-title">Parents' Guidelines</div>
    <p class="muted-sm mt-2">Parents are partners in learning. Your active support helps students succeed.</p>

    <ul class="mt-3">
      <li>Support your child's learning activities at home and encourage regular study.</li>
      <li>Attend school activities like book readings and other events when possible.</li>
      <li>Participate in at-home learning tasks: assignments, journals, devotions, practical activities.</li>
      <li>Submit assignments on time according to the schedule.</li>
      <li>Accompany and assist younger children during online sessions or practical tasks.</li>
    </ul>

    <div class="mt-3">
      <a class="btn btn-primary-accent" href="{{ url('/') }}">Back to Home</a>
    </div>
  </div>
</x-layout>
