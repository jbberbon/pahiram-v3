import axios from 'axios';

const backendApiClient = axios.create({
  headers: {
    'Content-Type': 'application/json',
  },
  withCredentials: true, // Ensures cookies are sent with the request (needed for session-based auth)
});

export default backendApiClient;