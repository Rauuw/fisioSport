import cv2
import mediapipe as mp

class ArmTracker:
    def __init__(self):
        self.prev_height = None
        self.is_moving = False

    def track_arm(self, wrist_y, elbow_y):
        if not self.is_moving and wrist_y < elbow_y:  # Flexión detectada
            self.is_moving = True
            self.prev_height = wrist_y
            return True
        elif self.is_moving and wrist_y > elbow_y:  # Fin del movimiento
            self.is_moving = False
            self.prev_height = None
        return False

def main():
    # Inicializar el módulo de MediaPipe para la detección de puntos clave
    mp_holistic = mp.solutions.holistic

    # Inicializar el capturador de video
    video_capture = cv2.VideoCapture(0)

    # Inicializar el detector de puntos clave
    with mp_holistic.Holistic(min_detection_confidence=0.5, min_tracking_confidence=0.5) as holistic:
        # Inicializar el contador
        counter = 0
        arm_tracker = ArmTracker()

        while True:
            ret, frame = video_capture.read()
            if not ret:
                break

            # Convertir la imagen de BGR a RGB
            rgb_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)

            # Procesar el frame para detectar puntos clave
            results = holistic.process(rgb_frame)

            # Dibujar los puntos clave en el frame
            if results.pose_landmarks:
                mp.solutions.drawing_utils.draw_landmarks(
                    frame, results.pose_landmarks, mp_holistic.POSE_CONNECTIONS)

                # Detectar flexión del brazo y contar solo una vez por movimiento
                left_wrist_y = results.pose_landmarks.landmark[mp_holistic.PoseLandmark.LEFT_WRIST].y * frame.shape[0]
                left_elbow_y = results.pose_landmarks.landmark[mp_holistic.PoseLandmark.LEFT_ELBOW].y * frame.shape[0]

                if arm_tracker.track_arm(left_wrist_y, left_elbow_y):
                    counter += 1

            # Mostrar el frame procesado con el contador
            cv2.putText(frame, f"Counter: {counter}", (10, frame.shape[0] - 10),
                        cv2.FONT_HERSHEY_SIMPLEX, 0.5, (0, 255, 0), 2)
            cv2.imshow('Video', frame)

            # Salir del bucle si se presiona 'q'
            if cv2.waitKey(1) & 0xFF == ord('q'):
                break

    # Liberar el capturador de video y cerrar las ventanas
    video_capture.release()
    cv2.destroyAllWindows()

if __name__ == "__main__":
    main()
