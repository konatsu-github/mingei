// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
import { getAuth } from 'firebase/auth';
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyDtyatZl8a8dpr0Zm4JGYpz-O0EkriyKIo",
  authDomain: "mingei-d2383.firebaseapp.com",
  projectId: "mingei-d2383",
  storageBucket: "mingei-d2383.appspot.com",
  messagingSenderId: "883478571510",
  appId: "1:883478571510:web:ac15dca9ad3e4e98ee3fd7",
  measurementId: "G-4F4QJ1KR21"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);

export const auth = getAuth(app);

