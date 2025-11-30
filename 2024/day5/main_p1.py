#f = open('in1.txt', 'r')
#g = open('in2.txt', 'r')

f = open('in1.txt', 'r')
g = open('in2.txt', 'r')

graph = {}
seq = []
in_deg = {}

def check_top_sort(seq):

    in_deg_curr = {}
    seq_set = set(seq)

    for node in seq:
        in_deg_curr[node] = 0
    
    for node in seq:
        for neighbour in graph[node]:
            if neighbour in seq_set:
                in_deg_curr[neighbour] += 1

    for node in seq:
        if in_deg_curr[node] != 0:
            return False
        else:
            for neighbour in graph[node]:
                if neighbour in seq_set:
                    in_deg_curr[neighbour] -= 1
    return True


def build_indeg():
    for node in graph:
        in_deg[node] = 0

    for node in graph:
        for neighbour in graph[node]:
                in_deg[neighbour] += 1


def read_graph():
    for line in f.readlines():
        l = line.strip()
        n1, n2 = [int(x) for x in l.split('|')]

        if n1 not in graph:
            graph[n1] = []

        if n2 not in graph:
            graph[n2] = []
        
        graph[n1].append(n2)


    
if __name__ == '__main__':
    read_graph()
    build_indeg()

    ans = 0

    for line in g.readlines():
        l = line.strip()
        v = [int(x) for x in l.split(',')]
        
        if check_top_sort(v):
            print(v, 'is OK')
            ans += v[len(v)//2]

    print(ans)

