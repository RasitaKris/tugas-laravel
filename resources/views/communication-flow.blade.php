{{-- resources/views/communication-flow.blade.php --}}
<x-layout :pageTitle="'Communication Flow'">
  <div class="soft-card">
    <div class="section-title">Communication Flow</div>
    <p class="muted-sm mt-2">We use dedicated channels to keep communication clear and to route questions to the right person.</p>

    <ul class="mt-3">
      <li><strong>HRT (Homeroom Team):</strong> Parent-specific administrative issues, discipline, worship events, and student-club coordination.</li>
      <li><strong>Tutors channel:</strong> Academic questions and subject-related concerns (lesson help, clarifications).</li>
      <li><strong>Finance Officer:</strong> Tuition payments, late payments, transfer confirmations, and finance administration.</li>
      <li><strong>Students & Parents Group:</strong> General announcements, community updates, event reminders.</li>
    </ul>

    <div class="mt-3">
      <a class="btn btn-primary-accent" href="{{ url('/') }}">Back to Home</a>
    </div>
  </div>
</x-layout>
